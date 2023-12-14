<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\ChargerTypeController;
use App\Http\Controllers\DesiredLocationController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProviderCompanyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleModelController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::prefix('v1')->group(function (){
    // predix public routes
    // public routes
    Route::prefix('public')->group(function (){
        Route::post('login', [LoginController::class, 'login']);
        Route::post('logout', [LoginController::class, 'logout']);
        Route::post('register', [UserController::class, 'store']);
        Route::post('survey', [DesiredLocationController::class, 'store']);
        Route::get('brands', [BrandController::class, 'index']);
        Route::get('charger-types/{companyId}', [ChargerTypeController::class, 'fetchByCompanyId']);
        Route::get('map-coordinates', [DesiredLocationController::class, 'mapCoordinates']);
        Route::post('feedback', [FeedbackController::class, 'store']);
        Route::get('provider-company', [ProviderCompanyController::class, 'index']);
        Route::get('vehicle-models/{brandId}', [VehicleModelController::class, 'fetchByBrandId']);
    });

    // predix private routes
    // private routes
    Route::middleware('auth:sanctum')->group(function (){
        Route::prefix('private')->group(function (){
            Route::get('/user/profile', [UserController::class, 'profile']);
            Route::patch('/user/profile', [UserController::class, 'update']);
            Route::delete('/user', [UserController::class, 'destroy']);
            Route::post('feedback', [FeedbackController::class, 'store']);

            // with role admin, provider
            Route::middleware('role:admin, provider')->group(function (){
                Route::get('desired-location', [DesiredLocationController::class, 'index']);
            });

            // with role admin
            Route::middleware('role:admin')->group(function (){
                Route::get('/users/count', [UserController::class, 'count']);
                Route::get('/surveys/count', [DesiredLocationController::class, 'count']);
                Route::get('/providers/count', [ProviderCompanyController::class, 'count']);
            });

            // not used currently
            // with role user
//            Route::middleware('role:user')->group(function (){
//                Route::get('brand', [BrandController::class, 'index']);
//                Route::get('chargertype', [ChargerTypeController::class, 'index']);
//                Route::get('provider-company', [ProviderCompanyController::class, 'index']);
//                Route::get('vehicle-model', [VehicleModelController::class, 'index']);
//                Route::get('user/{id}/desired-location', [UserController::class, 'getDesiredLocation']);
//                Route::post('user/{id}/desired-location', [UserController::class, 'setDesiredLocation']);
//            });

            // not used currently
            // with role provider
//            Route::middleware('role:provider')->group(function (){
//            });
        });

    });

});

