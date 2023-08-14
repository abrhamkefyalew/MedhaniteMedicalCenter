<?php

namespace App\Http\Resources\Api\V1\HospitalResources;

use App\Models\Hospital;
use Illuminate\Http\Request;
use App\Traits\Api\V1\GetMedia;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\V1\AddressResources\AddressResource;
use App\Http\Resources\Api\V1\EquipmentResources\EquipmentResource;
use App\Http\Resources\Api\V1\SpecialityResources\SpecialityResource;
use App\Http\Resources\Api\V1\DoctorResources\DoctorForCustomersResource;

class HospitalForCustomersResource extends JsonResource
{
    use GetMedia;
    
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // this resource is only for customers (normal users) and or may be for other hospital_staff
        return [
            'id' => $this->id,
            'hospital_name' => $this->hospital_name,
            'hospital_description' => $this->hospital_description,
            'hospital_email' => $this->hospital_email,
            'hospital_phone_number' => $this->hospital_phone_number,
            'hospital_specialities' => SpecialityResource::collection($this->whenLoaded('specialities')),
            // 'hospital_nigd_fikad_image_path' => $this->getOptimizedImagePath(Hospital::NIGD_FIKAD_HOSPITAL_PICTURE), // abrham comment : - IMAGES USE thumbnails for index and optimized for show (also use the plural methods for show and singular methods for index)
            // 'hospital_tin_number_image_path' => $this->getOptimizedImagePath(Hospital::TIN_NUMBER_HOSPITAL_PICTURE),
            // 'hospital_tiena_tibeka_image_path' => $this->getOptimizedImagePath(Hospital::TEINA_TIBEKA_HOSPITAL_PICTURE),
            'hospital_profile_image_path' => $this->getOptimizedImagePath(Hospital::PROFILE_PICTURE_HOSPITAL_PICTURE),
            'hospital_working_hours' => $this->hospital_working_hours,
            'hospital_address' => AddressResource::make($this->whenLoaded('address')),
            // abrham comment
            // load list of equipments
            'hospital_equipments' => EquipmentResource::collection($this->whenLoaded('equipments', function () {
                return $this->equipments->load('equipmentType');
            })),

            'hospital_doctors' => DoctorForCustomersResource::collection($this->whenLoaded('doctors', function () {
                return $this->doctors->load('address', 'specialities', 'media');
            })),
        ];
    }
}
