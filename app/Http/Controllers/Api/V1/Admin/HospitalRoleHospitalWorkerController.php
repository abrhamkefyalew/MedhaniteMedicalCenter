<?php

namespace App\Http\Controllers\Api\V1\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\HospitalRoleHospitalWorker;
use App\Http\Requests\Api\V1\AdminRequests\StoreHospitalRoleHospitalWorkerRequest;
use App\Http\Requests\Api\V1\AdminRequests\UpdateHospitalRoleHospitalWorkerRequest;

class HospitalRoleHospitalWorkerController extends Controller
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
    public function store(StoreHospitalRoleHospitalWorkerRequest $request)
    {
        //
        // $var = DB::transaction(function () {
            
        // });

        // return $var;
    }

    /**
     * Display the specified resource.
     */
    public function show(HospitalRoleHospitalWorker $hospitalRoleHospitalWorker)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHospitalRoleHospitalWorkerRequest $request, HospitalRoleHospitalWorker $hospitalRoleHospitalWorker)
    {
        //
        // $var = DB::transaction(function () {
            
        // });

        // return $var;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HospitalRoleHospitalWorker $hospitalRoleHospitalWorker)
    {
        //
    }
}
