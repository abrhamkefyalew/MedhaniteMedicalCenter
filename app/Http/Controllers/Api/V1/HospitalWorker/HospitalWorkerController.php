<?php

namespace App\Http\Controllers\Api\V1\HospitalWorker;

use Illuminate\Http\Request;
use App\Models\HospitalWorker;
use App\Http\Controllers\Controller;
use App\Services\Api\V1\FilteringService;
use App\Http\Resources\Api\V1\HospitalWorkerResources\HospitalWorkerForHospitalWorkerRoleResource;


/**
 * this controller is for hospitalWorkers with ROLE = HOSPITAL_WORKER
 */
class HospitalWorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $hospitalWorker_admin = HospitalWorker::find($user->id);

        $hospitalWorkers = HospitalWorker::where('hospital_id', $hospitalWorker_admin->hospital_id)->with('media')->latest()->paginate(FilteringService::getPaginate($request));
        return HospitalWorkerForHospitalWorkerRoleResource::collection($hospitalWorkers); // i used a resource = HospitalWorkerForHospitalWorkerRoleResource, which have limited hospitalWorker info, that is done only for ROLE = HOSPITAL_WORKER
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
    public function show(HospitalWorker $hospitalWorker)
    {
        $user = auth()->user();
        $hospitalWorker_logged_in = HospitalWorker::find($user->id);

        if ($hospitalWorker->hospital_id != $hospitalWorker_logged_in->hospital_id) {
            return response()->json(['message' => 'The User or User id specified does not exist'], 404);
        }

        return HospitalWorkerForHospitalWorkerRoleResource::make($hospitalWorker->load('media', 'address')); // i used a resource = HospitalWorkerForHospitalWorkerRoleResource, which have limited hospitalWorker info, that is done only for ROLE = HOSPITAL_WORKER
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
