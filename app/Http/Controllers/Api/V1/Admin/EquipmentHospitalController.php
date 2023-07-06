<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Models\EquipmentHospital;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\AdminRequests\StoreEquipmentHospitalRequest;
use App\Http\Requests\Api\V1\AdminRequests\UpdateEquipmentHospitalRequest;

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
