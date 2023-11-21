<?php

namespace App\Http\Controllers\Api\V1\Auth\HospitalWorkerAuth;

use Illuminate\Http\Request;
use App\Models\HospitalWorker;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Api\V1\AuthRequests\LoginHospitalWorkerRequest;
use App\Http\Resources\Api\V1\HospitalWorkerResources\HospitalWorkerForHospitalsResource;

class HospitalWorkerAuthController extends Controller
{
    public function login(LoginHospitalWorkerRequest $request)
    {
        // better use load than with, since here after all we get the data , we are checking if the password does match, 
        // if password does not match all the data and relation and Eager Load is wasted and the data will NOT be returned
        // do first get only the hospitalWorker and if the password matches then get the other relations using load()
        $hospitalWorker = HospitalWorker::with(['address', 'hospitalRoles', 'media'])->where('email', $request->email)->where('is_approved', 1)->first(); 

        if ($hospitalWorker) {
            if (Hash::check($request->password, $hospitalWorker->password)) {
                $tokenResult = $hospitalWorker->createToken('Personal Access Token', ['access-hospitalWorker']);
                $expiresAt = now()->addMinutes(50); // Set the expiration time to 50 minutes from now - -   -   -   -   now() = is helper function of laravel, - - - (it is NOT Carbon's)
                $token = $tokenResult->accessToken;
                $token->expires_at = $expiresAt;
                $token->save();
                
                //$hospitalWorker->sendEmailVerificationNotification();

                return response()->json(
                    [
                        'access_token' => $tokenResult->plainTextToken,
                        'token_abilities' => $tokenResult->accessToken->abilities,
                        'token_type' => 'Bearer',
                        'expires_at' => $tokenResult->accessToken->expires_at,
                        'data' => new HospitalWorkerForHospitalsResource($hospitalWorker),
                    ],
                    200
                );
            }
        }

        return response()->json(['message' => 'Login failed. Incorrect email or password.'], 400);
    }




    /**
     * LogOut from one device or current session only
     */
    public function logout(Request $request)
    {
        $request->user()->tokens()->where('id', $request->user()->currentAccessToken()->id)->delete();
    
        return response()->json(['message' => 'Logout successful'], 200);
    }

    

    /**
     * LogOut from All devices or Every other sessions
     */
    public function logoutAllDevices(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logout from all devices successful'], 200);
    }
}

