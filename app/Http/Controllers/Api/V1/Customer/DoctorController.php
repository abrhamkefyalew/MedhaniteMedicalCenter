<?php

namespace App\Http\Controllers\Api\V1\Customer;

use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Api\V1\FilteringService;
use App\Services\Api\V1\Customer\DoctorFilteringService;
use App\Http\Resources\Api\V1\DoctorResources\DoctorForCustomersResource;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $doctor = Doctor::whereNotNull('id');

        if ($request->has('name')){
            DoctorFilteringService::byDoctorName($request, $doctor);
        }

        if ($request->has('full')){
            $doctorDataFull = $doctor->with('media', 'specialities', 'hospitals', 'address')->latest()->paginate(FilteringService::getPaginate($request));

            return DoctorForCustomersResource::collection($doctorDataFull);
        }
        
        $doctorData = $doctor->with('media', 'specialities')->latest()->paginate(FilteringService::getPaginate($request));

        return DoctorForCustomersResource::collection($doctorData);
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
    public function show(Doctor $doctor)
    {
        return DoctorForCustomersResource::make($doctor->load('hospitals', 'media', 'address', 'specialities'));
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
