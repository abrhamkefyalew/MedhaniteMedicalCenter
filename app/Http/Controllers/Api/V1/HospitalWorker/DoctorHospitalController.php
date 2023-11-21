<?php

namespace App\Http\Controllers\Api\V1\HospitalWorker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DoctorHospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // use resource = DoctorForHospitalsResource.php
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // $var = DB::transaction(function () {
            
        // });

        // return $var;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // use resource = DoctorForHospitalsResource.php
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        // $var = DB::transaction(function () {
            
        // });

        // return $var;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
