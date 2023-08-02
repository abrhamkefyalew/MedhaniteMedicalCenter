<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Admin\AdminController;
use App\Http\Controllers\Api\V1\Admin\DoctorController;
use App\Http\Controllers\Api\V1\Admin\HospitalController;
use App\Http\Controllers\Api\V1\Admin\EquipmentController;
use App\Http\Controllers\Api\V1\Admin\SpecialityController;
use App\Http\Controllers\Api\V1\Admin\HospitalRoleController;
use App\Http\Controllers\Api\V1\Admin\EquipmentTypeController;
use App\Http\Controllers\Api\V1\Admin\DoctorHospitalController;
use App\Http\Controllers\Api\V1\Admin\DoctorSpecialityController;
use App\Http\Controllers\Api\V1\Admin\EquipmentHospitalController;
use App\Http\Controllers\Api\V1\Admin\HospitalSpecialityController;
use App\Http\Controllers\Api\V1\Auth\AdminAuth\AdminAuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// test codes here
//Route::get('/getAllAdmins', [AdminController::class, 'index']);


Route::prefix('v1')->group(function () {

    // open routes


    
    // admin routes
    Route::prefix('admin')->group(function () {
        Route::prefix('')->group(function () {
            // there should NOT be admin registration, -  
            // admin should be seeded or stored by an already existing admin -
            // there is a route for admin storing
            Route::post('/login', [AdminAuthController::class, 'login']);

        });

        Route::middleware(['auth:sanctum', 'abilities:access-admin'])->group(function () {
            Route::prefix('')->group(function () {
                Route::post('/logout', [AdminAuthController::class, 'logout']);
                Route::post('/logout-all-devices', [AdminAuthController::class, 'logoutAllDevices']);
            });

            Route::prefix('admins')->group(function () {
                Route::post('/', [AdminController::class, 'store']);
                Route::get('/', [AdminController::class, 'index']);
                Route::prefix('/{admin}')->group(function () {
                    Route::get('/', [AdminController::class, 'show']);
                    Route::put('/', [AdminController::class, 'update']);
                    Route::delete('/', [AdminController::class, 'destroy']);
                }); 
            });

            Route::prefix('hospitals')->group(function () {
                Route::post('/', [HospitalController::class, 'store']);
                Route::post('/with-hospital-worker-admin-admin', [HospitalController::class, 'storeHospitalWithHospitalAdmin']);
                Route::get('/', [HospitalController::class, 'index']);
                Route::prefix('/{hospital}')->group(function () {
                    Route::get('/', [HospitalController::class, 'show']);
                    Route::put('/', [HospitalController::class, 'update']);
                    Route::delete('/', [HospitalController::class, 'destroy']);
                }); 
            });

            Route::prefix('hospital-roles')->group(function () {
                Route::get('/', [HospitalRoleController::class, 'index']);
                Route::post('/', [HospitalRoleController::class, 'store']);
                Route::prefix('/{hospitalRole}')->group(function () {
                    Route::get('/', [HospitalRoleController::class, 'show']);
                    Route::put('/', [HospitalRoleController::class, 'update']);
                    Route::delete('/', [HospitalRoleController::class, 'destroy']);
                    Route::post('/restore', [HospitalRoleController::class, 'restore']);
                });
            });


            Route::prefix('specialities')->group(function () {
                Route::post('/', [SpecialityController::class, 'store']);
                Route::get('/', [SpecialityController::class, 'index']);
                Route::prefix('/{speciality}')->group(function () {
                    Route::get('/', [SpecialityController::class, 'show']);
                    Route::put('/', [SpecialityController::class, 'update']);
                    Route::delete('/', [SpecialityController::class, 'destroy']);
                }); 
            });

            Route::prefix('hospital-specialities')->group(function () {
                Route::match(['post', 'put'], '/{hospital}', HospitalSpecialityController::class); // for invoke method
                // Route::post('/', [HospitalSpecialityController::class, 'store']);
                // Route::get('/', [HospitalSpecialityController::class, 'index']);
                // Route::prefix('/{hospitalSpeciality}')->group(function () {
                //     Route::get('/', [HospitalSpecialityController::class, 'show']);
                //     Route::put('/', [HospitalSpecialityController::class, 'update']);
                //     Route::delete('/', [HospitalSpecialityController::class, 'destroy']);
                // }); 
            });

            Route::prefix('doctors')->group(function () {
                Route::post('/', [DoctorController::class, 'store']);
                Route::get('/', [DoctorController::class, 'index']);
                Route::prefix('/{doctor}')->group(function () {
                    Route::get('/', [DoctorController::class, 'show']);
                    Route::put('/', [DoctorController::class, 'update']);
                    Route::delete('/', [DoctorController::class, 'destroy']);
                }); 
            });

            Route::prefix('doctor-specialities')->group(function () {
                Route::match(['post', 'put'], '/{doctor}', [DoctorSpecialityController::class, 'sync']);
                // Route::post('/', [DoctorSpecialityController::class, 'store']);
                Route::get('/', [DoctorSpecialityController::class, 'index']);
                // Route::prefix('/{doctorSpeciality}')->group(function () {
                //     Route::get('/', [DoctorSpecialityController::class, 'show']);
                //     Route::put('/', [DoctorSpecialityController::class, 'update']);
                //     Route::delete('/', [DoctorSpecialityController::class, 'destroy']);
                // }); 
            });

            Route::prefix('doctor-hospital')->group(function () {
                Route::match(['post', 'put'], '/{hospital}', [DoctorHospitalController::class, 'sync']);
                // Route::post('/', [DoctorSpecialityController::class, 'store']);
                Route::get('/', [DoctorHospitalController::class, 'index']);
                // Route::prefix('/{doctorSpeciality}')->group(function () {
                //     Route::get('/', [DoctorSpecialityController::class, 'show']);
                //     Route::put('/', [DoctorSpecialityController::class, 'update']);
                //     Route::delete('/', [DoctorSpecialityController::class, 'destroy']);
                // }); 
            });

            Route::prefix('equipment_types')->group(function () {
                Route::post('/', [EquipmentTypeController::class, 'store']);
                Route::get('/', [EquipmentTypeController::class, 'index']);
                Route::prefix('/{equipment_type}')->group(function () {
                    Route::get('/', [EquipmentTypeController::class, 'show']);
                    Route::put('/', [EquipmentTypeController::class, 'update']);
                    Route::delete('/', [EquipmentTypeController::class, 'destroy']);
                }); 
            });

            Route::prefix('equipments')->group(function () {
                Route::post('/', [EquipmentController::class, 'store']);
                Route::get('/', [EquipmentController::class, 'index']);
                Route::prefix('/{equipment}')->group(function () {
                    Route::get('/', [EquipmentController::class, 'show']);
                    Route::put('/', [EquipmentController::class, 'update']);
                    Route::delete('/', [EquipmentController::class, 'destroy']);
                }); 
            });

            Route::prefix('equipment-hospitals')->group(function () {
                Route::match(['post', 'put'], '/{hospital}', [EquipmentHospitalController::class, 'sync']);
                // Route::post('/', [EquipmentHospitalController::class, 'store']);
                Route::get('/', [EquipmentHospitalController::class, 'index']);
                // Route::prefix('/{equipmentHospital}')->group(function () {
                //     Route::get('/', [EquipmentHospitalController::class, 'show']);
                //     Route::put('/', [EquipmentHospitalController::class, 'update']);
                //     Route::delete('/', [EquipmentHospitalController::class, 'destroy']);
                // }); 
            });

            

        });
    });
    


    // hospital workers route



    // doctors route


    // user routes (user Normal = customer)
    Route::prefix('customer')->group(function () {
        Route::prefix('')->group(function () {
            // this is for login sent here by medhanite old
            Route::post('/login', [AdminAuthController::class, 'testingUserLogin']);

        });
    });

});