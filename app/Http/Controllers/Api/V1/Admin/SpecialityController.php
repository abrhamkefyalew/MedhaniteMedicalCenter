<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Models\Speciality;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Api\V1\FilteringService;
use App\Http\Requests\Api\V1\AdminRequests\StoreSpecialityRequest;
use App\Http\Requests\Api\V1\AdminRequests\UpdateSpecialityRequest;
use App\Http\Resources\Api\V1\SpecialityResources\SpecialityResource;

class SpecialityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $this->authorize('viewAny', Speciality::class);

        // scope should be used here
        if (isset($request['paginate'])) {
            if ($request['paginate'] == "all"){
                $speciality = Speciality::get();
            }
        } else {
            $speciality = Speciality::paginate(FilteringService::getPaginate($request));
        }

        // // for the ADMIN and CUSTOMER ONLY: -  if the admin wants we can return only the speciality or the hospitals and doctors that have this speciality 
        // // or USE SCOPE
        // if ($request->has('hospital')){
        //     FilteringService::filterByHospitals($request, $admin);
        // }
        // // for the ADMIN and CUSTOMER ONLY: -  if the admin wants we can return only the speciality or the hospitals and doctors that have this speciality 
        // // or USE SCOPE
        // if ($request->has('hospital')){
        //     FilteringService::filterByDoctors($request, $admin);
        // }

        return SpecialityResource::collection($speciality);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSpecialityRequest $request)
    {
        //
        $speciality = Speciality::create($request->validated());

        // for the admin if the admin wants we can return only the speciality   or the hospitals and doctors that have this speciality 
        return SpecialityResource::make($speciality);
    }

    /**
     * Display the specified resource.
     */
    public function show(Speciality $speciality)
    {
        $this->authorize('view', $speciality);

        return SpecialityResource::make($speciality);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSpecialityRequest $request, Speciality $speciality)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Speciality $speciality)
    {
        //
    }
}
