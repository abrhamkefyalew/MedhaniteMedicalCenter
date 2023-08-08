<?php

namespace App\Http\Resources\Api\V1\DoctorResources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DoctorForCustomersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // this resource is only for the customer (normal users)
        return parent::toArray($request);
    }
}
