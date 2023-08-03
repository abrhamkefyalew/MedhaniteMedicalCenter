<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Models\Hospital;
use App\Models\HospitalRole;
use Illuminate\Http\Request;
use App\Models\HospitalWorker;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\Api\V1\MediaService;
use App\Services\Api\V1\FilteringService;
use App\Services\Api\V1\Admin\HospitalFilteringService;
use App\Http\Requests\Api\V1\AdminRequests\StoreHospitalRequest;
use App\Http\Requests\Api\V1\AdminRequests\UpdateHospitalRequest;
use App\Http\Resources\Api\V1\HospitalResources\HospitalResource;
use App\Http\Requests\Api\V1\AdminRequests\StoreHospitalWithHospitalAdminRequest;

class HospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Hospital::class);

        $hospitals = Hospital::whereNotNull('id');

        if ($request->has('hospital_name_search')){
            HospitalFilteringService::byHospitalNameAndDescription($request, $hospitals);
        }

        // abrham comment: - should use with for paginated index data, since load will disable the pagination
        $hospitalData = $hospitals->with('media', 'specialities')->latest()->paginate(FilteringService::getPaginate($request));

        return HospitalResource::collection($hospitalData);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHospitalRequest $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeHospitalWithHospitalAdmin(StoreHospitalWithHospitalAdminRequest $request)
    {
        // 
        return DB::transaction(function () use ($request) {

            // dump(json_encode($request->hospital_working_hours));
            $hospital = Hospital::create([
                'hospital_name' => $request['hospital_name'],
                'hospital_description' => $request['hospital_description'],
                'hospital_email' => $request['hospital_email'],
                'hospital_phone_number' => $request['hospital_phone_number'],
                'hospital_working_hours' => $request->hospital_working_hours,
                'hospital_is_active' => (int) (isset($request['hospital_is_active']) ? $request['hospital_is_active'] : 1), // this works
                'hospital_is_approved' => (int) $request->input('hospital_is_approved', 0), // this works also
            ]);

            $hospitalWorker = $hospital->hospitalWorkers()->create([
                'first_name' => $request['first_name'],
                'last_name' => $request['last_name'],
                'email' => $request['email'],
                'phone_number' => $request['phone_number'],
                'job_title' => $request['job_title'],
                'is_active' => (int) (isset($request['is_active']) ? $request['is_active'] : 1), // this works
                'is_approved' => (int) $request->input('is_approved', 0), // this works also
                'password' => $request['password'],
            ]);


            $hospitalRoleValue = HospitalRole::where('hospital_role_title', HospitalRole::HOSPITAL_ADMIN_ADMIN_ROLE)->first('id')->id;

            $hospitalWorker->hospitalRoles()->attach($hospitalRoleValue);
            // $hospitalWorker->hospitalRoles()->attach($request->input('hospital_worker_role_ids')); // this is if the admin insert the hospital worker role
            // $hospitalWorker->hospitalRoles()->create(['hospital_role_id' => $hospitalRoleValue]); // DOES THIS WORK Correctly? Check it


            $hasLocationData = ($request->has('hospital_country') ||
                $request->has('hospital_city') ||
                $request->has('hospital_latitude') ||
                $request->has('hospital_longitude') ||
                ($request->has('hospital_relative_location') && (count($request->hospital_relative_location) > 0))
            );
            if ($hasLocationData) {
                $hospital->address()->create([
                    'country' => $request->input('hospital_country'),
                    'city' => $request->input('hospital_city'),
                    'latitude' => $request->input('hospital_latitude'),
                    'longitude' => $request->input('hospital_longitude'),
                    'relative_location' => $request->input('hospital_relative_location'),
                ]);
            }

            // NO hospital image remove, since it is the first time the hospital is being stored
            // also use the MediaService class to remove image

            if ($request->has('hospital_nigd_fikad_image')) {
                $file = $request->file('hospital_nigd_fikad_image');
                $clearMedia = false; // or true // // NO hospital image remove, since it is the first time the hospital is being stored
                $collectionName = Hospital::NIGD_FIKAD_HOSPITAL_PICTURE;
                MediaService::storeImage($hospital, $file, $clearMedia, $collectionName);
            }

            if ($request->has('hospital_tin_number_image')) {
                $file = $request->file('hospital_tin_number_image');
                $clearMedia = false; // or true // // NO hospital image remove, since it is the first time the hospital is being stored
                $collectionName = Hospital::TIN_NUMBER_HOSPITAL_PICTURE;
                MediaService::storeImage($hospital, $file, $clearMedia, $collectionName);
            }

            if ($request->has('hospital_tiena_tibeka_image')) {
                $file = $request->file('hospital_tiena_tibeka_image');
                $clearMedia = false; // or true // // NO hospital image remove, since it is the first time the hospital is being stored 
                $collectionName = Hospital::TEINA_TIBEKA_HOSPITAL_PICTURE;
                MediaService::storeImage($hospital, $file, $clearMedia, $collectionName);
            }

            if ($request->has('hospital_profile_image')) {
                $file = $request->file('hospital_profile_image');
                $clearMedia = false; // or true // // NO hospital image remove, since it is the first time the hospital is being stored
                $collectionName = Hospital::PROFILE_PICTURE_HOSPITAL_PICTURE;
                MediaService::storeImage($hospital, $file, $clearMedia, $collectionName);
            }

            if ($request->has('country') || $request->has('city')) {
                $hospitalWorker->address()->create([
                    'country' => $request->input('country'),
                    'city' => $request->input('city'),
                ]);
            }

            // NO hospital worker image remove, since it is the first time the hospital worker is being stored
            // also use the MediaService class to remove image

            if ($request->has('profile_image')) {
                $file = $request->file('profile_image');
                $clearMedia = false; // or true // // NO hospital worker image remove, since it is the first time the hospital worker is being stored
                $collectionName = HospitalWorker::PROFILE_PICTURE_HOSPITAL_WORKER_PICTURE;
                MediaService::storeImage($hospitalWorker, $file, $clearMedia, $collectionName);
            }

            return HospitalResource::make($hospital->load('hospitalWorkers', 'media', 'address', 'specialities', 'doctors', 'equipments'));
        });
    }

    /**
     * Display the specified resource.
     */
    public function show(Hospital $hospital)
    {
        $this->authorize('view', $hospital);

        return HospitalResource::make($hospital->load('hospitalWorkers', 'media', 'address', 'specialities', 'doctors', 'equipments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHospitalRequest $request, Hospital $hospital)
    {
        return DB::transaction(function () use ($request, $hospital) {

            $hospital->update($request->validated());

            $hasLocationData = ($request->has('hospital_country') ||
                $request->has('hospital_city') ||
                $request->has('hospital_latitude') ||
                $request->has('hospital_longitude') ||
                ($request->has('hospital_relative_location') && (count($request->hospital_relative_location) > 0))
            );
            if ($hasLocationData) {
                if ($hospital->address) {
                    $hospital->address()->update([
                        'country' => $request->input('hospital_country'),
                        'city' => $request->input('hospital_city'),
                        'latitude' => $request->input('hospital_latitude'),
                        'longitude' => $request->input('hospital_longitude'),
                        'relative_location' => $request->input('hospital_relative_location'),
                    ]);
                } else {
                    $hospital->address()->create([
                        'country' => $request->input('hospital_country'),
                        'city' => $request->input('hospital_city'),
                        'latitude' => $request->input('hospital_latitude'),
                        'longitude' => $request->input('hospital_longitude'),
                        'relative_location' => $request->input('hospital_relative_location'),
                    ]);
                }
            }

            // in the medias to make the image defalut the code shall delete the old one and recreate is as the latest

            if ($request->input('hospital_nigd_fikad_image_remove', false)) { // the false is the default,  (if the user inputs value then the default(false) can be overridden by the user input)
                $clearMedia = $request['hospital_nigd_fikad_image_remove'];
                $collectionName = Hospital::NIGD_FIKAD_HOSPITAL_PICTURE;
                MediaService::clearImage($hospital, $clearMedia, $collectionName);
            }

            if ($request->input('hospital_tin_number_image_remove', false)) {
                $clearMedia = $request['hospital_tin_number_image_remove'];
                $collectionName = Hospital::TIN_NUMBER_HOSPITAL_PICTURE;
                MediaService::clearImage($hospital, $clearMedia, $collectionName);
            }

            if ($request->input('hospital_tiena_tibeka_image_remove', false)) {
                $clearMedia = $request['hospital_tiena_tibeka_image_remove'];
                $collectionName = Hospital::TEINA_TIBEKA_HOSPITAL_PICTURE;
                MediaService::clearImage($hospital, $clearMedia, $collectionName);
            }

            if ($request->input('hospital_profile_image_remove', false)) {
                $clearMedia = $request['hospital_profile_image_remove'];
                $collectionName = Hospital::PROFILE_PICTURE_HOSPITAL_PICTURE;
                MediaService::clearImage($hospital, $clearMedia, $collectionName);
            }


            // Then UPLOAD The IMAGES
            if ($request->has('hospital_nigd_fikad_image')) {
                $file = $request->file('hospital_nigd_fikad_image');
                $clearMedia = false; // or true // // NO hospital image remove, since it is the first time the hospital is being stored
                $collectionName = Hospital::NIGD_FIKAD_HOSPITAL_PICTURE;
                MediaService::storeImage($hospital, $file, $clearMedia, $collectionName);
            }

            if ($request->has('hospital_tin_number_image')) {
                $file = $request->file('hospital_tin_number_image');
                $clearMedia = false; // or true // // NO hospital image remove, since it is the first time the hospital is being stored
                $collectionName = Hospital::TIN_NUMBER_HOSPITAL_PICTURE;
                MediaService::storeImage($hospital, $file, $clearMedia, $collectionName);
            }

            if ($request->has('hospital_tiena_tibeka_image')) {
                $file = $request->file('hospital_tiena_tibeka_image');
                $clearMedia = false; // or true // // NO hospital image remove, since it is the first time the hospital is being stored 
                $collectionName = Hospital::TEINA_TIBEKA_HOSPITAL_PICTURE;
                MediaService::storeImage($hospital, $file, $clearMedia, $collectionName);
            }

            if ($request->has('hospital_profile_image')) {
                $file = $request->file('hospital_profile_image');
                $clearMedia = false; // or true // // NO hospital image remove, since it is the first time the hospital is being stored
                $collectionName = Hospital::PROFILE_PICTURE_HOSPITAL_PICTURE;
                MediaService::storeImage($hospital, $file, $clearMedia, $collectionName);
            }



            // while updating hospital worker roles a person should not update his own role, 
            // the hospital worker admin admin only should update other hospital worker roles but NOT his own
            // the medhanite super admin can change any hospital workers role (but NOT recommended)

            return HospitalResource::make($hospital->load('hospitalWorkers', 'media', 'address', 'specialities', 'doctors', 'equipments'));
        });
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hospital $hospital)
    {
        //
        $this->authorize('delete', $hospital);
    }

    /**
     * method to manage images
     * 
     * to delete an image or
     * 
     * make 1 of the multiple images DEFAULT from every single collection 
     * 
     */
    public function manageImages(Request $request)
    {
        // we need
        // image id
        // image collection :- (we get it from the image id)
        // model ID, : - (we get it from the sanctum TOKEN)
        // Model &  the Model name [Ex app/Models/ModelName] : - (we get it from the sanctum TOKEN)

        if (isset($request['remove_image'])){
            // by now you will have the image_id to be removed 
            // get user_ID and MODEL from token
            // from the media table
                // check the user_id  & model with the Image_id
                // if that image_id is indeed aligns with the user_id & model
                    // delete the image

            // DELETE THE IMAGE WITH THAT ID
        }

    }
}
