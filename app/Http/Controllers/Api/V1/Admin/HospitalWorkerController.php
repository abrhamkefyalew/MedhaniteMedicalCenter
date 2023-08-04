<?php

namespace App\Http\Controllers\Api\V1\Admin;

use Illuminate\Http\Request;
use App\Models\HospitalWorker;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\Api\V1\MediaService;
use App\Services\Api\V1\FilteringService;
use App\Http\Requests\Api\V1\AdminRequests\StoreHospitalWorkerRequest;
use App\Http\Requests\Api\V1\AdminRequests\UpdateHospitalWorkerRequest;
use App\Http\Resources\Api\V1\HospitalWorkerResources\HospitalWorkerResource;

class HospitalWorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', HospitalWorker::class);
        $doctors = HospitalWorker::with('media', 'specialities', 'hospital')->latest()->paginate(FilteringService::getPaginate($request));
 
        return HospitalWorkerResource::collection($doctors);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHospitalWorkerRequest $request)
    {
        //
        // return DB::transaction(function() use($request) {

        // });
    }

    /**
     * Display the specified resource.
     */
    public function show(HospitalWorker $hospitalWorker)
    {
        $this->authorize('view', $hospitalWorker);

        return HospitalWorkerResource::make($hospitalWorker->load('hospital', 'media', 'address'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHospitalWorkerRequest $request, HospitalWorker $hospitalWorker)
    {
        $var = DB::transaction(function () use($request, $hospitalWorker) {

            $hospitalWorker->update($request->validated());

            if ($request->has('country') || $request->has('city')){
                if ($hospitalWorker->address) {
                    $hospitalWorker->address()->update([
                        'country' => $request->input('country'),
                        'city' => $request->input('city'),
                    ]);
                } else {
                    $hospitalWorker->address()->create([
                        'country' => $request->input('country'),
                        'city' => $request->input('city'),
                    ]);
                }
            }

            // sync the hospital worker Role also // by admin
            // only SUPER_ADMIN or HOSPITAL_ADMIN_ADMIN can change the hospital worker role // also HOSPITAL_ADMIN_ADMIN can NOT change or demote His OWN ROLE

            
            if ($request->input('profile_image_remove', false)) { // the false is the default,  (if the user inputs value then the default(false) can be overridden by the user input)
                $clearMedia = $request['profile_image_remove'];
                $collectionName = HospitalWorker::PROFILE_PICTURE_HOSPITAL_WORKER_PICTURE;
                MediaService::clearImage($hospitalWorker, $clearMedia, $collectionName);
            }
            
            if ($request->has('profile_image')) {
                $file = $request->file('profile_image');
                $clearMedia = false; // or true // // NO hospital worker image remove, since we are uploading now
                $collectionName = HospitalWorker::PROFILE_PICTURE_HOSPITAL_WORKER_PICTURE;
                MediaService::storeImage($hospitalWorker, $file, $clearMedia, $collectionName);
            }

            return HospitalWorkerResource::make($hospitalWorker->load('hospital', 'media', 'address'));
            
        });

        return $var;

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HospitalWorker $hospitalWorker)
    {
        //
        $this->authorize('delete', $hospitalWorker);
    }
}
