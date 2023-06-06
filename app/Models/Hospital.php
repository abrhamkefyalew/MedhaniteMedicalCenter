<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Hospital extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'hospital_name',
        'hospital_description',
        'hospital_email',
        'hospital_phone_number',
        'hospital_working_hours',
        'hospital_is_active',
        'hospital_is_approved',
    ];

    protected $table = 'hospitals';

    public function address()
    {
        return $this->morphOne(Address::class, 'addressable');
    }

    public function hospitalWorkers()
    {
        return $this->hasMany(HospitalWorker::class);
    }

    public function specialities()
    {
        return $this->belongsToMany(Speciality::class);
    }


    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('optimized')
            ->width(1000)
            ->height(1000);

        $this->addMediaConversion('thumb')
            ->width(150)
            ->height(150);
    }
}
