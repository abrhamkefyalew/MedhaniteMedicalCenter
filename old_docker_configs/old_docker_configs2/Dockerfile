FROM php:8.1-fpm

# Install system dependencies for PHP and NGINX
RUN apt-get update \
    && apt-get install -y libzip-dev libpng-dev libjpeg-dev libfreetype6-dev libonig-dev zlib1g-dev nginx supervisor

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ \
    && docker-php-ext-install pdo_mysql gd mbstring zip exif \
    && docker-php-ext-enable pdo_mysql gd mbstring zip exif

# Install Redis extension
RUN pecl install -o -f redis \
    && rm -rf /tmp/pear \
    && docker-php-ext-enable redis

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set the working directory
WORKDIR /var/www/html

# Copy the Laravel project to the container
COPY . /var/www/html

# Copy the composer.json and composer.lock files to the container
COPY composer.json composer.lock /var/www/html/

# Install the project dependencies using Composer
RUN composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev

# Set the file permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Remove default configuration files
RUN rm /etc/nginx/sites-enabled/default

# Remove default configuration files
RUN rm /etc/nginx/sites-available/default

# Copy the NGINX configuration file to the container
COPY nginx.conf /etc/nginx/conf.d/default.conf

# Copy medhanteMedicalCenterConf to sites-available
COPY nginx.conf /etc/nginx/sites-available/default

# Create symbolic link to sites-enabled
RUN ln -s /etc/nginx/sites-available/default /etc/nginx/sites-enabled/default

# Copy the supervisord configuration file to the container
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Expose port 80 for NGINX
EXPOSE 80

# Start supervisord
CMD ["/usr/bin/supervisord", "-n", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
