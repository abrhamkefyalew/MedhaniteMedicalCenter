<?php

namespace App\Http\Controllers\Api\V1\Customer;

use App\Models\Hospital;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Api\V1\FilteringService;
use App\Services\Api\V1\Customer\HospitalFilteringService;
use App\Http\Resources\Api\V1\HospitalResources\HospitalForCustomersResource;

class HospitalController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $hospital = Hospital::whereNotNull('id');

        if ($request->has('hospital_name_search')){
            HospitalFilteringService::byHospitalNameAndDescription($request, $hospital);
        }

        $hospitalData = $hospital->with('media', 'specialities', 'address')->latest()->paginate(FilteringService::getPaginate($request));

        return HospitalForCustomersResource::collection($hospitalData);
    }


    /**
     * Display the specified resource.
     */
    public function show(Hospital $hospital)
    {
        return HospitalForCustomersResource::make($hospital->load('media', 'address', 'specialities', 'doctors', 'equipments'));
    }
}
