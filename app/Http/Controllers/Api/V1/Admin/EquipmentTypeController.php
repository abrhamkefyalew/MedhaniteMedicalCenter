<?php

namespace App\Http\Controllers\Api\V1\Admin;

use Illuminate\Http\Request;
use App\Models\EquipmentType;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\Api\V1\FilteringService;
use App\Http\Requests\Api\V1\AdminRequests\StoreEquipmentTypeRequest;
use App\Http\Requests\Api\V1\AdminRequests\UpdateEquipmentTypeRequest;
use App\Http\Resources\Api\V1\EquipmentTypeResources\EquipmentTypeResource;

class EquipmentTypeController extends Controller
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
                $equipmentType = EquipmentType::get();
            }
        } else {
            $equipmentType = EquipmentType::paginate(FilteringService::getPaginate($request));
        }


        return EquipmentTypeResource::collection($equipmentType);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEquipmentTypeRequest $request)
    {
        //
        $var = DB::transaction(function () use($request) {
            $equipmentType = EquipmentType::create($request->validated());

            // for the admin if the admin wants we can return only the equipment    or the hospitals that have this equipment 
            return EquipmentTypeResource::make($equipmentType);
        });

        return $var;
    }

    /**
     * Display the specified resource.
     */
    public function show(EquipmentType $equipmentType)
    {
        //
        // do auth here
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEquipmentTypeRequest $request, EquipmentType $equipmentType)
    {
        //
        $var = DB::transaction(function () use($request, $equipmentType) {
            $equipmentType->update($request->validated());

            return EquipmentTypeResource::make($equipmentType);
        });

        return $var;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EquipmentType $equipmentType)
    {
        //
    }
}
