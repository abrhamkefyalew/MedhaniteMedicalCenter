<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Models\HospitalWorker;
use Illuminate\Support\Facades\DB;
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
        $this->authorize('viewAny', HospitalWorker::class);


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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHospitalWorkerRequest $request, HospitalWorker $hospitalWorker)
    {
        return DB::transaction(function () use($request, $hospitalWorker) {

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
            
        });

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
