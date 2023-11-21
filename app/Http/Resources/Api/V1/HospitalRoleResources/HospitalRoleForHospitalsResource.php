<?php

namespace App\Http\Resources\Api\V1\HospitalRoleResources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HospitalRoleForHospitalsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'hospital_role_title' => $this->hospital_role_title,
            // abrham comment
            // since hospital workers are in each different hospitals, we can not load all hospital workers under certain hospital role, it should be hospital specific
        ];
    }
}
