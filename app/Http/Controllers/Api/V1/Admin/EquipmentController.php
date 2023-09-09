<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Models\Equipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\Api\V1\FilteringService;
use App\Http\Requests\Api\V1\AdminRequests\StoreEquipmentRequest;
use App\Http\Requests\Api\V1\AdminRequests\UpdateEquipmentRequest;
use App\Http\Resources\Api\V1\EquipmentResources\EquipmentResource;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // do auth here

        // scope should be used here
        if (isset($request['paginate'])) {
            if ($request['paginate'] == "all"){
                $equipmentType = Equipment::get();
            }
        } else {
            $equipmentType = Equipment::with('equipmentType')->paginate(FilteringService::getPaginate($request));
        }


        return EquipmentResource::collection($equipmentType);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEquipmentRequest $request)
    {
        //
        $equipment = Equipment::create($request->validated());

        // for the admin if the admin wants we can return only the equipment    or the hospitals that have this equipment 
        return EquipmentResource::make($equipment);
    }

    /**
     * Display the specified resource.
     */
    public function show(Equipment $equipment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEquipmentRequest $request, Equipment $equipment)
    {
        //
        DB::transaction(function () use($request, $equipment) {
            $equipment->update($request->validated());

            return EquipmentResource::make($equipment);
        });
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equipment $equipment)
    {
        //
    }
}
