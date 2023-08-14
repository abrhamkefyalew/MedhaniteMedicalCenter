<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Models\Doctor;
use App\Models\Hospital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\Api\V1\MediaService;
use App\Services\Api\V1\FilteringService;
use App\Services\Api\V1\Admin\DoctorFilteringService;
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

        $doctors = Doctor::whereNotNull('id');

        if ($request->has('name')){
            DoctorFilteringService::byDoctorName($request, $doctors);
        }

        $doctorData = $doctors->with('media', 'specialities', 'hospitals')->latest()->paginate(FilteringService::getPaginate($request));

        return DoctorResource::collection($doctorData);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDoctorRequest $request)
    {
        //
        return DB::transaction(function () use ($request) {
            $doctor = Doctor::create([
                'first_name' => $request['first_name'],
                'last_name' => $request['last_name'],
                'email' => $request['email'],
                'phone_number' => $request['phone_number'],
                'is_active' => (int) (isset($request['is_active']) ? $request['is_active'] : 1), // this works
                'is_approved' => (int) $request->input('is_approved', 0), // this works also
                'password' => $request['password'],
            ]);

            
            if ($request->has('hospital_ids') && (count($request->hospital_ids) > 0))
            {
                // we should use attach NOT sync since it is the FiRST Time a doctor is attached to a hospital
                $doctor->hospitals()->attach($request->hospital_ids);
            }
            

            // do if to see if there are specialities in the request
            if ($request->has('speciality_ids') && (count($request->speciality_ids) > 0))
            {
                $doctor->specialities()->sync($request->speciality_ids);
            }
            
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

            return DoctorResource::make($doctor->load('hospitals', 'media', 'address', 'specialities'));

        });
    }

    /**
     * Display the specified resource.
     */
    public function show(Doctor $doctor)
    {
        $this->authorize('view', $doctor);
        return DoctorResource::make($doctor->load('hospitals', 'media', 'address', 'specialities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDoctorRequest $request, Doctor $doctor)
    {
        //
        return DB::transaction(function() use($request, $doctor) {
            $doctor->update($request->validated());

            if ($request->has('country') || $request->has('city')){
                if ($doctor->address) {
                    $doctor->address()->update([
                        'country' => $request->input('country'),
                        'city' => $request->input('city'),
                    ]);
                } else {
                    $doctor->address()->create([
                        'country' => $request->input('country'),
                        'city' => $request->input('city'),
                    ]);
                }
            }

            // update speciality
            // check if there are specialities in the request
            if ($request->has('speciality_ids') && (count($request->speciality_ids) > 0))
            {
                $doctor->specialities()->sync($request->speciality_ids);
            }

            // update doctor hospital relation
            if ($request->has('hospital_ids') && (count($request->hospital_ids) > 0))
            {
                $doctor->hospitals()->sync($request->hospital_ids);
            }
            

            // remove doctor profile image
            if ($request->has('profile_image_remove', false)) {
                $clearMedia = $request['profile_image_remove'];; // or true // // NO image remove, since it is the first time the doctor is being stored
                $collectionName = Doctor::PROFILE_PICTURE_DOCTOR_PICTURE;
                MediaService::clearImage($doctor, $clearMedia, $collectionName);
            }

            // update doctor profile image
            if ($request->has('profile_image')) {
                $file = $request->file('profile_image');
                $clearMedia = false; // or true // // NO image remove,  since we are uploading now
                $collectionName = Doctor::PROFILE_PICTURE_DOCTOR_PICTURE;
                MediaService::storeImage($doctor, $file, $clearMedia, $collectionName);
            }

            // remove doctor medical license image
            if($request->has('doctor_medical_license_image_remove', false)){
                $clearMedia = $request['doctor_medical_license_image_remove'];
                $collectionName = Doctor::MEDICAL_LICENSE_DOCTOR_PICTURE;
                MediaService::clearImage($doctor, $clearMedia, $collectionName);
            }

            // update doctor medical license image
            if ($request->has('doctor_medical_license_image')) {
                $file = $request->file('doctor_medical_license_image');
                $clearMedia = false; // or true // // NO image remove,  since we are uploading now
                $collectionName = Doctor::MEDICAL_LICENSE_DOCTOR_PICTURE;
                MediaService::storeImage($doctor, $file, $clearMedia, $collectionName);
            }

            return DoctorResource::make($doctor->load('hospitals', 'media', 'address', 'specialities'));
            
        });
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctor $doctor)
    {
        //
    }
}
