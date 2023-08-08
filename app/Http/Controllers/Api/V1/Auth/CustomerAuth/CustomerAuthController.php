<?php

namespace App\Http\Controllers\Api\V1\Auth\CustomerAuth;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\AuthRequests\LoginCustomerForMedhaniteOldRequest;
use App\Http\Resources\Api\V1\CustomerResources\CustomerForMedhaniteOldResource;

class CustomerAuthController extends Controller
{
    //

    public function testingUserLogin(Request $request)
    {
        if ($request) {
            $phone = $request->phone_number;
        }

        $newJwtToken = '3|xhkGW3UMA4Hcw3Anf0Ca1uoTPi1EFEiv0i0VUxlG';

        return response()->json([
            'new_system_token' => $newJwtToken,
            'user_phone_number___' => $phone
        ]);
    }

    public function customerLoginTest(LoginCustomerForMedhaniteOldRequest $request)
    {
        $var = DB::transaction(function () use ($request) {

            // Get the phone number from the request
            $phoneNumber = $request->input('phone_number');

            // Check if the customer exists in the database
            $customer = Customer::where('phone_number', $phoneNumber)->where('is_approved', 1)->first();

            if (!$customer) {
                // check is the customer is dis-approved (dis approved)
                $customerCheck = Customer::where('phone_number', $phoneNumber)->first();
                if ($customerCheck){
                    if ($customerCheck->is_approved != 1){
                        return response()->json(['message' => "Login failed. This user has been dis-approved."], 401);
                    }
                }
                

                // customer does not exist, create a new customer with the provided phone number and with approved=1
                $customer = Customer::create([
                    'phone_number' => $phoneNumber,
                    'is_approved' => 1,
                ]);
            }

            // we should delete all the previous remaining tokens of the user before he log in every time and then give him one new token
            // the customer can have only one token at a time in the database
            $customer->tokens()->delete();     // delete all other tokens of this customer

            // Generate a new token for the user with the access-client ability
            $tokenResult = $customer->createToken('Personal Access Token', ['access-customer']);
            $newJwtToken = $tokenResult->plainTextToken;

            // RETURN TYPE 1
            // Return the new system JWT token to the old Medhanite
            // return response()->json([
            //     'new_system_token' => $tokenResult->plainTextToken,
            // ]);

            // RETURN TYPE 2
            // for the future return all of his data from here to the old medhanite also // LIKE THIS
            return response()->json(
                [
                    'access_token' => $tokenResult->plainTextToken,
                    'token_abilities' => $tokenResult->accessToken->abilities,
                    'token_type' => 'Bearer',
                    'expires_at' => $tokenResult->accessToken->expires_at,
                    'data' => new CustomerForMedhaniteOldResource($customer),
                ],
                200
            );
        });

        // in Old Medhanite check if the response is 200 then return both of the tokens
        // like this
        // if ($response->status() == 200){

        // }

        return $var;
    }
}
