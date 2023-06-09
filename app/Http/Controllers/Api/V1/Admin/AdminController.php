<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Services\Api\V1\FilteringService;
use App\Http\Resources\Api\V1\AdminResources\AdminResource;
use App\Http\Requests\Api\V1\AdminRequests\StoreAdminRequest;
use App\Http\Requests\Api\V1\AdminRequests\UpdateAdminRequest;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        // $response = Http::withToken('176|KnJ4sbTG8ynrROMCd3rqukyH7bBUA0naeKOMwF5J')->get('http://127.0.0.1:4050/api/v1/admin/admins');
        // //$response->body();

        // return $response->body();

        //  $response = Http::withToken('176|KnJ4sbTG8ynrROMCd3rqukyH7bBUA0naeKOMwF5J')->get('http://127.0.0.1:4050/api/v1/admin/admins');
        // // //$response->body();

        //  return $response->body();

        // $response = Http::withToken('176|KnJ4sbTG8ynrROMCd3rqukyH7bBUA0naeKOMwF5J')->get('https://api.linkedin.com/v2/people/(id:{abrham-kefyalew-30466721a})');
        // return $response->body();

        $this->authorize('viewAny', Admin::class);

        $admin = Admin::whereNotNull('id');
        
        if ($request->has('name')){
            FilteringService::filterByAllNames($request, $admin);
        }
        $adminData = $admin->paginate(FilteringService::getPaginate($request));

        return AdminResource::collection($adminData);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdminRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        //
        $this->authorize('view', $admin);
        
        return AdminResource::make($admin);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdminRequest $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
