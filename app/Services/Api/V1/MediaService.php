<?php

namespace App\Services\Api\V1;

use Illuminate\Support\Str;

class MediaService
{
    public static function storeImage($object, $image, $clearMedia = false, $mediaCollection = 'images')
    {
        if ($clearMedia) {
            $object->clearMediaCollection($mediaCollection);
        }

        $extension = $image->getClientOriginalExtension();

        $object->addMedia($image)->usingFileName(Str::random(12).$extension)->toMediaCollection($mediaCollection);

        return $object;
    }

    public static function storeImages($object, $images, $clearMedia = false, $mediaCollection = 'images')
    {
        if ($clearMedia) {
            $object->clearMediaCollection($mediaCollection);
        }

        foreach ($images as $image) {
            $extension = $image->getClientOriginalExtension();

            $object->addMedia($image)->usingFileName(Str::random(12).$extension)->toMediaCollection($mediaCollection);
        }

        return $object;
    }
}
