<?php

namespace App\Http\Resources\Api\V1\SpecialityResources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SpecialityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return [
        //     'id' => $this->id,
        //     'speciality_name' => $this->speciality_name,
        //     'speciality_description' => $this->speciality_description,
        //     // 'pivot' => $this->pivot, // this causes error when you load speciality resource only // to get list of speciality
        // ];

        return parent::toArray($request); // this returns the pivot also along with all of the data in specialities table
    }
}
