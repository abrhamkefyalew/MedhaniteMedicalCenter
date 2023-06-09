<?php

namespace App\Http\Resources\Api\V1\RoleResources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\V1\AdminResources\AdminResource;
use App\Http\Resources\Api\V1\PermissionResources\PermissionResource;

class RoleResource extends JsonResource
{
    /*
    protected $includePermissionGroups;

    // the $resource variable is $role object
    public function __construct($resource, bool $includePermissionGroups = false)
    {
        parent::__construct($resource);

        if (! $includePermissionGroups) {
            $includePermissionGroups = request()->has('permission-groups');
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
            'title' => $this->title,
            'admins_count' => $this->whenCounted('admins'),
            'admins' => AdminResource::collection($this->whenLoaded('admins')),
            'permissions' => PermissionResource::collection($this->whenLoaded('permissions')),
            // 'permission_groups' => $this->when($this->includePermissionGroups, function () {
            //     return RoleService::getPermissionGroups(Role::find($this->id));
            // }),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ];
    }
}
