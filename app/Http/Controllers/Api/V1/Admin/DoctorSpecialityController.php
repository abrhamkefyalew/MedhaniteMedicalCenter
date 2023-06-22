<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Models\Doctor;
use App\Models\DoctorSpeciality;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\Api\V1\FilteringService;
use App\Http\Resources\Api\V1\SpecialityResources\SpecialityResource;
use App\Http\Requests\Api\V1\AdminRequests\SyncDoctorSpecialityRequest;
use App\Http\Requests\Api\V1\AdminRequests\StoreDoctorSpecialityRequest;
use App\Http\Requests\Api\V1\AdminRequests\UpdateDoctorSpecialityRequest;

class DoctorSpecialityController extends Controller
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
    public function sync(SyncDoctorSpecialityRequest $request, Doctor $doctor)
    {
        return DB::transaction(function () use ($request, $doctor) {
            $doctor->specialities()->sync($request->speciality_ids);

            $doctorSpecialities = $doctor->specialities()->paginate(FilteringService::getPaginate($request));

            return SpecialityResource::collection($doctorSpecialities);
        });
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDoctorSpecialityRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DoctorSpeciality $doctorSpeciality)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDoctorSpecialityRequest $request, DoctorSpeciality $doctorSpeciality)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DoctorSpeciality $doctorSpeciality)
    {
        //
    }
}
