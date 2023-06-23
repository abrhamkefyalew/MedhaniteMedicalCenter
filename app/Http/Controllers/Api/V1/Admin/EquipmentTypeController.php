<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Models\EquipmentType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\AdminRequests\StoreEquipmentTypeRequest;
use App\Http\Requests\Api\V1\AdminRequests\UpdateEquipmentTypeRequest;

class EquipmentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEquipmentTypeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(EquipmentType $equipmentType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEquipmentTypeRequest $request, EquipmentType $equipmentType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EquipmentType $equipmentType)
    {
        //
    }
}
