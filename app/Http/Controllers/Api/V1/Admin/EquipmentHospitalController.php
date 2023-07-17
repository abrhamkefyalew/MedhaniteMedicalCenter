<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Models\Hospital;
use App\Models\EquipmentHospital;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\Api\V1\FilteringService;
use App\Http\Requests\Api\V1\AdminRequests\SyncEquipmentHospitalRequest;
use App\Http\Requests\Api\V1\AdminRequests\StoreEquipmentHospitalRequest;
use App\Http\Requests\Api\V1\AdminRequests\UpdateEquipmentHospitalRequest;
use App\Http\Resources\Api\V1\EquipmentResources\EquipmentResource;

class EquipmentHospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store, update and delete a newly created resource in storage.
     */
    public function sync(SyncEquipmentHospitalRequest $request, Hospital $hospital)
    {
        return DB::transaction(function () use ($request, $hospital) {
            $hospital->equipments()->sync($request->equipment_ids);

            $equipmentHospital = $hospital->equipments()->paginate(FilteringService::getPaginate($request));

            return EquipmentResource::collection($equipmentHospital);
        });
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEquipmentHospitalRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(EquipmentHospital $equipmentHospital)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEquipmentHospitalRequest $request, EquipmentHospital $equipmentHospital)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EquipmentHospital $equipmentHospital)
    {
        //
    }
}
