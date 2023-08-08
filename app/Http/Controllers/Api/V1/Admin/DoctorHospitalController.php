<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Models\Hospital;
use App\Models\DoctorHospital;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\Api\V1\FilteringService;
use App\Http\Requests\Api\V1\AdminRequests\SyncDoctorHospitalRequest;
use App\Http\Requests\Api\V1\AdminRequests\StoreDoctorHospitalRequest;
use App\Http\Requests\Api\V1\AdminRequests\UpdateDoctorHospitalRequest;
use App\Http\Resources\Api\V1\DoctorHospitalResources\DoctorHospitalResource;


class DoctorHospitalController extends Controller
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
    public function sync(SyncDoctorHospitalRequest $request, Hospital $hospital)
    {
        return DB::transaction(function () use ($request, $hospital) {
            $hospital->doctors()->sync($request->doctor_ids);

            $doctorHospitals = $hospital->doctors()->paginate(FilteringService::getPaginate($request));

            return DoctorHospitalResource::collection($doctorHospitals);
        });
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDoctorHospitalRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DoctorHospital $doctorHospital)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDoctorHospitalRequest $request, DoctorHospital $doctorHospital)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DoctorHospital $doctorHospital)
    {
        //
    }
}
