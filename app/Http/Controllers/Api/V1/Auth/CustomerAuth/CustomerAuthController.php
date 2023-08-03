<?php

namespace App\Http\Controllers\Api\V1\Auth\CustomerAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerAuthController extends Controller
{
    //

    public function testingUserLogin(Request $request)
    {
        if ($request)
        {
            $phone = $request->phone_number;
        }

        $newJwtToken = '3|xhkGW3UMA4Hcw3Anf0Ca1uoTPi1EFEiv0i0VUxlG';

        return response()->json([
            'new_system_token' => $newJwtToken,
            'user_phone_number___' => $phone
        ]);
    }
}
