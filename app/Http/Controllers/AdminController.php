<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
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
