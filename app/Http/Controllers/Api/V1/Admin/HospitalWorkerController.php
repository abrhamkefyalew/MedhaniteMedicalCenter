<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Models\HospitalWorker;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\AdminRequests\StoreHospitalWorkerRequest;
use App\Http\Requests\Api\V1\AdminRequests\UpdateHospitalWorkerRequest;

class HospitalWorkerController extends Controller
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
    public function store(StoreHospitalWorkerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(HospitalWorker $hospitalWorker)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHospitalWorkerRequest $request, HospitalWorker $hospitalWorker)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HospitalWorker $hospitalWorker)
    {
        //
    }
}
