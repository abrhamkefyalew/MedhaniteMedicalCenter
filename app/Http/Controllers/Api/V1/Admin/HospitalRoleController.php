<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Models\HospitalRole;
use App\Http\Controllers\Controller;
use App\Services\Api\V1\FilteringService;
use App\Http\Requests\Api\V1\AdminRequests\StoreHospitalRoleRequest;
use App\Http\Requests\Api\V1\AdminRequests\UpdateHospitalRoleRequest;
use App\Http\Resources\Api\V1\HospitalRoleResources\HospitalRoleResource;

class HospitalRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $this->authorize('viewAny', HospitalRole::class);

        $hospitalRole = HospitalRole::paginate(FilteringService::getPaginate());

        return HospitalRoleResource::collection($hospitalRole);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHospitalRoleRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(HospitalRole $hospitalRole)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHospitalRoleRequest $request, HospitalRole $hospitalRole)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HospitalRole $hospitalRole)
    {
        //
    }
}
