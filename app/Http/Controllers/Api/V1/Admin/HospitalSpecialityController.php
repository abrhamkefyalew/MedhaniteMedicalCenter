<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Models\HospitalSpeciality;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\AdminRequests\StoreHospitalSpecialityRequest;
use App\Http\Requests\Api\V1\AdminRequests\UpdateHospitalSpecialityRequest;

class HospitalSpecialityController extends Controller
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
    public function store(StoreHospitalSpecialityRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(HospitalSpeciality $hospitalSpeciality)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHospitalSpecialityRequest $request, HospitalSpeciality $hospitalSpeciality)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HospitalSpeciality $hospitalSpeciality)
    {
        //
    }
}
