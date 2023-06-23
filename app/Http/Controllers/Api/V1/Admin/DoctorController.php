<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Models\Doctor;
use App\Models\Hospital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\Api\V1\MediaService;
use App\Services\Api\V1\FilteringService;
use App\Http\Resources\Api\V1\DoctorResources\DoctorResource;
use App\Http\Requests\Api\V1\AdminRequests\StoreDoctorRequest;
use App\Http\Requests\Api\V1\AdminRequests\UpdateDoctorRequest;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Doctor::class);
        $doctors = Doctor::with('media', 'specialities', 'hospital')->latest()->paginate(FilteringService::getPaginate($request));

        return DoctorResource::collection($doctors);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDoctorRequest $request, Hospital $hospital)
    {
        //
        return DB::transaction(function () use ($request, $hospital) {
            $doctor = $hospital->doctors()->create([
                'first_name' => $request['first_name'],
                'last_name' => $request['last_name'],
                'email' => $request['email'],
                'phone_number' => $request['phone_number'],
                'is_active' => (int) (isset($request['is_active']) ? $request['is_active'] : 1), // this works
                'is_approved' => (int) $request->input('is_approved', 0), // this works also
                'password' => $request['password'],
            ]);

            $doctor->specialities()->sync($request->speciality_ids);

            if ($request->has('country') || $request->has('city')) {
                $doctor->address()->create([
                    'country' => $request->input('country'),
                    'city' => $request->input('city'),
                ]);
            }

            if ($request->has('profile_image')) {
                $file = $request->file('profile_image');
                $clearMedia = false; // or true // // NO image remove, since it is the first time the doctor is being stored
                $collectionName = Doctor::PROFILE_PICTURE_DOCTOR_PICTURE;
                MediaService::storeImage($doctor, $file, $clearMedia, $collectionName);
            }

            if ($request->has('doctor_medical_license_image')) {
                $file = $request->file('doctor_medical_license_image');
                $clearMedia = false; // or true // // NO image remove, since it is the first time the doctor is being stored
                $collectionName = Doctor::MEDICAL_LICENSE_DOCTOR_PICTURE;
                MediaService::storeImage($doctor, $file, $clearMedia, $collectionName);
            }

            return DoctorResource::make($doctor->load('hospital', 'media', 'address', 'specialities'));

        });
    }

    /**
     * Display the specified resource.
     */
    public function show(Doctor $doctor)
    {
        $this->authorize('view', $doctor);
        return DoctorResource::make($doctor->load('hospital', 'media', 'address', 'specialities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDoctorRequest $request, Doctor $doctor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctor $doctor)
    {
        //
    }
}
