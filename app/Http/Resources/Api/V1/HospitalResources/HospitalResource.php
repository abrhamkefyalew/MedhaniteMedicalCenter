<?php

namespace App\Http\Resources\Api\V1\HospitalResources;

use App\Models\Hospital;
use Illuminate\Http\Request;
use App\Traits\Api\V1\GetMedia;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\V1\AddressResources\AddressResource;
use App\Http\Resources\Api\V1\SpecialityResources\SpecialityResource;
use App\Http\Resources\Api\V1\HospitalWorkerResources\HospitalWorkerResource;

class HospitalResource extends JsonResource
{
    use GetMedia;
    
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'hospital_name' => $this->hospital_name,
            'hospital_description' => $this->hospital_description,
            'hospital_email' => $this->hospital_email,
            'hospital_phone_number' => $this->hospital_phone_number,
            'hospital_is_active' => $this->hospital_is_active,
            'hospital_is_approved' => $this->hospital_is_approved,
            'hospital_created_at' => $this->created_at,
            'hospital_updated_at' => $this->updated_at,
            'hospital_specialities' => SpecialityResource::collection($this->whenLoaded('specialities')),
            'hospital_nigd_fikad_image_path' => $this->getOptimizedImagePath(Hospital::NIGD_FIKAD_HOSPITAL_PICTURE),
            'hospital_tin_number_image_path' => $this->getOptimizedImagePath(Hospital::TIN_NUMBER_HOSPITAL_PICTURE),
            'hospital_tiena_tibeka_image_path' => $this->getOptimizedImagePath(Hospital::TEINA_TIBEKA_HOSPITAL_PICTURE),
            'hospital_profile_image_path' => $this->getOptimizedImagePath(Hospital::PROFILE_PICTURE_HOSPITAL_PICTURE),
            'hospital_working_hours' => $this->hospital_working_hours,
            'hospital_address' => AddressResource::make($this->whenLoaded('address')),
            // abrham comment
            // load speciality 
            // load list of equipments
            // load doctors - (with doctors speciality)
            'hospital_worker' => HospitalWorkerResource::collection($this->whenLoaded('hospitalWorkers', function () {
                return $this->hospitalWorkers->load('address', 'hospitalRoles', 'media');
            })),
        ];
    }
}
