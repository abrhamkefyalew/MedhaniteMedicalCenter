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
        //
        $this->authorize('viewAny', Hospital::class);
        
        // abrham comment: - should use with for paginated index data, since load will disable the pagination
        $hospitals = Hospital::with('media', 'specialities')->latest()->paginate(FilteringService::getPaginate($request));

        return HospitalResource::collection($hospitals);
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
        return DB::transaction(function () use($request) {
            
            // dd(json_encode($request->hospital_working_hours));
            $hospital = Hospital::create([
                'hospital_name' => $request['hospital_name'],
                'hospital_description' => $request['hospital_description'],
                'hospital_email' => $request['hospital_email'],
                'hospital_phone_number' => $request['hospital_phone_number'],
                'hospital_working_hours' => $request->hospital_working_hours,
                'hospital_is_active' => $request['hospital_is_active'],
                'hospital_is_approved' => $request['hospital_is_approved'],
            ]);
    
            $hospitalWorker = $hospital->hospitalWorkers()->create([
                'first_name' => $request['first_name'],
                'last_name' => $request['last_name'],
                'email' => $request['email'],
                'phone_number' => $request['phone_number'],
                'job_title' => $request['job_title'],
                'is_active' => $request['is_active'],
                'is_approved' => $request['is_approved'],
                'password' => $request['password'],
            ]);

            
            $hospitalRoleValue = HospitalRole::where('hospital_role_title', HospitalRole::HOSPITAL_ADMIN_ADMIN_ROLE)->first('id')->id;

            $hospitalWorker->hospitalRoles()->attach($hospitalRoleValue);
            // $hospitalWorker->hospitalRoles()->attach($request->input('hospital_worker_role_ids')); // this is if the admin insert the hospital worker role
            // $hospitalWorker->hospitalRoles()->create(['hospital_role_id' => $hospitalRoleValue]); // DOES THIS WORK Correctly? Check it
            

            $hasLocationData = (
                $request->has('hospital_country') || 
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
            // also use the MediaService to remove image
            
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
            // also use the MediaService to remove image

            if ($request->has('profile_image')) {
                $file = $request->file('profile_image');
                $clearMedia = false; // or true // // NO hospital worker image remove, since it is the first time the hospital worker is being stored
                $collectionName = HospitalWorker::PROFILE_PICTURE_HOSPITAL_WORKER_PICTURE;
                MediaService::storeImage($hospitalWorker, $file, $clearMedia, $collectionName);
            }

            return HospitalResource::make($hospital->load('hospitalWorkers', 'media', 'address', 'specialities'));


        });
        
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Hospital $hospital)
    {
        //
        $this->authorize('view', $hospital);
        return HospitalResource::make($hospital->load('hospitalWorkers', 'media', 'address', 'specialities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHospitalRequest $request, Hospital $hospital)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hospital $hospital)
    {
        //
    }
}
