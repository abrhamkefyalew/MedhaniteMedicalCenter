<?php

namespace App\Traits\Api\V1;

trait GetMedia
{
    public function getOptimizedImagePaths()
    {
        $images = [];
        if ($this->getMedia('images')) {
            foreach ($this->getMedia('images')->sortByDesc('created_at') as $media) {
                $images[] = $media->getUrl('optimized');
            }
        }

        return $images;
    }

    public function getOptimizedImagePath($mediaCollectionName = 'images')
    {
        $image = null;

        if ($image = $this->getMedia($mediaCollectionName)->latest()->first()) {
            // $image = $image->getUrl('optimized');
            $image = url($image->getUrl('optimized'));
        }

        return $image;
    }

    public function getThumbnailImagePath()
    {
        $image = null;

        if ($image = $this->getMedia('images')->first()) {
            if ($image->hasGeneratedConversion('thumb')) {
                $image = $image->getUrl('thumb');
            }
        }

        return $image;
    }

    public function getThumbnailImagePaths()
    {
        $images = [];
        if ($this->getMedia('images')) {
            foreach ($this->getMedia('images')->sortByDesc('created_at') as $media) {
                if ($media->hasGeneratedConversion('thumb')) {
                    $images[] = $media->getUrl('thumb');
                }
            }
        }

        return $images;
    }
}
