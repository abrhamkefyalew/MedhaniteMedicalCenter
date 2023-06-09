<?php

namespace App\Http\Resources\Api\V1\AdminResources;

use Illuminate\Http\Request;
use App\Traits\Api\V1\GetMedia;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\V1\RoleResources\RoleResource;
use App\Http\Resources\Api\V1\PermissionResources\PermissionResource;

class AdminResource extends JsonResource
{
    use GetMedia;

    /*
    protected $includePermissionGroups;

    // the $resource variable is $admin object
    public function __construct($resource, bool $includePermissionGroups = false)
    {
        parent::__construct($resource);

        if (! $includePermissionGroups) {
            $includePermissionGroups = request()->has('admin-permission-groups');
        }

        $this->includePermissionGroups = $includePermissionGroups;
    }
    */

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'is_active' => $this->is_active,
            'profile_image_path' => $this->getOptimizedImagePath(),
            'roles' => RoleResource::collection($this->whenLoaded('roles')),
            'permissions' => PermissionResource::collection($this->whenLoaded('permissions')),
            // 'permission_groups' => $this->when($this->includePermissionGroups, function () {
            //     return RoleService::getPermissionGroupsByAdmin(Admin::find($this->id));
            // }),
        ];
    }
}
