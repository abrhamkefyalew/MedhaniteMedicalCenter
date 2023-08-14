<?php

namespace App\Http\Resources\Api\V1\DoctorResources;

use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Traits\Api\V1\GetMedia;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\V1\AddressResources\AddressResource;
use App\Http\Resources\Api\V1\SpecialityResources\SpecialityResource;
use App\Http\Resources\Api\V1\HospitalResources\HospitalForCustomersResource;

class DoctorForCustomersResource extends JsonResource
{
    use GetMedia;
    
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // this resource is only for the customer (normal users) and or may be for other hospital_staff
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            // 'is_active' => $this->is_active,
            // 'is_approved' => $this->is_approved,
            'doctor_specialities' => SpecialityResource::collection($this->whenLoaded('specialities')),
            'profile_image_path' => $this->getOptimizedImagePath(Doctor::PROFILE_PICTURE_DOCTOR_PICTURE),
            // 'doctor_medical_license_image_path' => $this->getOptimizedImagePath(Doctor::MEDICAL_LICENSE_DOCTOR_PICTURE),
            'address' => AddressResource::make($this->whenLoaded('address')),
            'hospitals' => HospitalForCustomersResource::collection($this->whenLoaded('hospitals', function () {
                return $this->hospitals->load('address', 'media', 'specialities'); // include speciality, equipments, and doctors for the future (abrham comment)
            })), // this also works
            //'hospital' => new HospitalResource($this->hospital), // this also works
        ];
    }
}
