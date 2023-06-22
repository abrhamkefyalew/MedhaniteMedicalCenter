<?php

namespace App\Http\Resources\Api\V1\DoctorResources;

use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Traits\Api\V1\GetMedia;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\V1\AddressResources\AddressResource;
use App\Http\Resources\Api\V1\HospitalResources\HospitalResource;
use App\Http\Resources\Api\V1\SpecialityResources\SpecialityResource;

class DoctorResource extends JsonResource
{
    use GetMedia;
    
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // this resource is only for the super_admin, hospital_admin_admin, hospital_admin NOT for normal user and Other hospital_workers
        return [
            'id' => $this->id,
            'hospital_id' => $this->hospital_id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'is_active' => $this->is_active,
            'is_approved' => $this->is_approved,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'doctor_specialities' => SpecialityResource::collection($this->whenLoaded('specialities')),
            'profile_image_path' => $this->getOptimizedImagePath(Doctor::PROFILE_PICTURE_DOCTOR_PICTURE),
            'doctor_medical_license_image_path' => $this->getOptimizedImagePath(Doctor::MEDICAL_LICENSE_DOCTOR_PICTURE),
            'address' => AddressResource::make($this->whenLoaded('address')),
            'hospital' => HospitalResource::make($this->whenLoaded('hospital', function () {
                return $this->hospital->load('address', 'media', 'specialities'); // include speciality, equipments, and doctors for the future (abrham comment)
            })), // this also works
            //'hospital' => new HospitalResource($this->hospital), // this also works
        ];
    }
}
