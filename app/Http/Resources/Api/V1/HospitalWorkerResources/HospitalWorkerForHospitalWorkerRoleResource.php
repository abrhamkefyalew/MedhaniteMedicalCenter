<?php

namespace App\Http\Resources\Api\V1\HospitalWorkerResources;

use Illuminate\Http\Request;
use App\Models\HospitalWorker;
use App\Traits\Api\V1\GetMedia;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\V1\AddressResources\AddressResource;
use App\Http\Resources\Api\V1\HospitalRoleResources\HospitalRoleForHospitalsResource;

class HospitalWorkerForHospitalWorkerRoleResource extends JsonResource
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
            'hospital_id' => $this->hospital_id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'job_title' => $this->job_title,
            'is_active' => $this->is_active,
            'is_approved' => $this->is_approved,
            'profile_image_path' => $this->getOptimizedImagePath(HospitalWorker::PROFILE_PICTURE_HOSPITAL_WORKER_PICTURE),
            'hospital_worker_roles' => HospitalRoleForHospitalsResource::collection($this->whenLoaded('hospitalRoles')),
            'address' => AddressResource::make($this->whenLoaded('address')),
        ];
    }
}
