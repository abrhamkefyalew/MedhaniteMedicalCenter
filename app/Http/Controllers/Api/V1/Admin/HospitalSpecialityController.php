<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Models\Hospital;
use App\Models\HospitalSpeciality;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\Api\V1\FilteringService;
use App\Http\Resources\Api\V1\SpecialityResources\SpecialityResource;
use App\Http\Requests\Api\V1\AdminRequests\StoreHospitalSpecialityRequest;
use App\Http\Requests\Api\V1\AdminRequests\InvokeHospitalSpecialityRequest;
use App\Http\Requests\Api\V1\AdminRequests\UpdateHospitalSpecialityRequest;

class HospitalSpecialityController extends Controller
{
    
    /**
     * Store, Update and Remove resources in storage. // alternative to the sync function but works alone in a controller
     */
    public function __invoke(InvokeHospitalSpecialityRequest $request, Hospital $hospital)
    {
        return DB::transaction(function () use ($request, $hospital) {
            $hospital->specialities()->sync($request->speciality_ids);

            $hospitalSpecialities = $hospital->specialities()->paginate(FilteringService::getPaginate($request));

            return SpecialityResource::collection($hospitalSpecialities);
        });
        
    }
    

    // we should also do index and show below, so the invocable will be replaced by sync

    
    // /**
    //  * Store, Update and Remove resources in storage. // alternative to the __invoke function but can work with other functions in a controller
    //  */
    // public function sync(SyncHospitalSpecialityRequest $request)
    // {
    //     //
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(StoreHospitalSpecialityRequest $request)
    // {
    //     //
    // }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(HospitalSpeciality $hospitalSpeciality)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(UpdateHospitalSpecialityRequest $request, HospitalSpeciality $hospitalSpeciality)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(HospitalSpeciality $hospitalSpeciality)
    // {
    //     //
    // }
}
