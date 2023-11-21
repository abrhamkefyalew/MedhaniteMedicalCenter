<?php

namespace App\Http\Controllers\Api\V1\HospitalWorker;

use App\Models\HospitalRole;
use Illuminate\Http\Request;
use App\Models\HospitalWorker;
use App\Http\Controllers\Controller;
use App\Services\Api\V1\FilteringService;
use App\Http\Resources\Api\V1\HospitalWorkerResources\HospitalWorkerForHospitalsResource;


/**
 * this controller is ONLY for hospitalWorkers with ROLE = HOSPITAL_ADMIN_ADMIN & HOSPITAL_ADMIN
 */
class HospitalAdminHospitalWorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $hospitalWorker_admin_logged_in = HospitalWorker::find($user->id);
        // $hospitalWorker_role = $hospitalWorker->hospitalRoles->pluck('hospital_role_title'); // within array, inside array
        $hospitalWorker_role = $hospitalWorker_admin_logged_in->hospitalRoles->value('hospital_role_title'); // without array (NOT array, NOT in array, outside array), exact value

        if ($hospitalWorker_role != HospitalRole::HOSPITAL_ADMIN_ADMIN_ROLE && $hospitalWorker_role != HospitalRole::HOSPITAL_ADMIN_ROLE) {
            return response()->json(['message' => 'You need to be Hospital Admin for this operation'], 400);
        }

        $hospitalWorkers = HospitalWorker::where('hospital_id', $hospitalWorker_admin_logged_in->hospital_id)->with('media', 'hospital')->latest()->paginate(FilteringService::getPaginate($request));
        return HospitalWorkerForHospitalsResource::collection($hospitalWorkers);
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
        $hospitalWorker_admin_logged_in = HospitalWorker::find($user->id);
        // $hospitalWorker_role = $hospitalWorker->hospitalRoles->pluck('hospital_role_title'); // within array, inside array
        $hospitalWorker_role = $hospitalWorker_admin_logged_in->hospitalRoles->value('hospital_role_title'); // without array (NOT array, NOT in array, outside array), exact value

        if ($hospitalWorker_role != HospitalRole::HOSPITAL_ADMIN_ADMIN_ROLE && $hospitalWorker_role != HospitalRole::HOSPITAL_ADMIN_ROLE) {
            return response()->json(['message' => 'You need to be Hospital Admin for this operation'], 400);
        }

        if ($hospitalWorker->hospital_id != $hospitalWorker_admin_logged_in->hospital_id) {
            return response()->json(['message' => 'The User or User id specified does not exist'], 404);
        }

        return HospitalWorkerForHospitalsResource::make($hospitalWorker->load('hospital', 'media', 'address'));
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
