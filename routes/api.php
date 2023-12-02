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
        // todo: register
        Route::post('register', [LoginController::class, 'register']);

        Route::get('brand', [BrandController::class, 'index']);
        Route::get('chargertype', [ChargerTypeController::class, 'index']);
        Route::get('desired-location', [DesiredLocationController::class, 'index']);
        Route::post('feedback', [FeedbackController::class, 'store']);
        Route::get('provider-company', [ProviderCompanyController::class, 'index']);
        Route::get('vehicle-model', [VehicleModelController::class, 'index']);
    });

    // predix private routes
    // private routes
    Route::middleware('auth:sanctum')->group(function (){
        Route::prefix('private')->group(function (){
            Route::get('/user', function (Request $request) {
                return $request->user();
            });


            // with role admin
            Route::middleware('role:admin')->group(function (){
                Route::apiResource('brand', BrandController::class);
                Route::apiResource('chargertype', ChargerTypeController::class);
                Route::apiResource('desired-location', DesiredLocationController::class);
                Route::apiResource('feedback', FeedbackController::class);
                Route::apiResource('provider-company', ProviderCompanyController::class);
                Route::apiResource('user', UserController::class);
                Route::apiResource('vehicle-model', VehicleModelController::class);
            });
            // with role user
            Route::middleware('role:user')->group(function (){
                Route::get('brand', [BrandController::class, 'index']);
                Route::get('chargertype', [ChargerTypeController::class, 'index']);
                Route::get('desired-location', [DesiredLocationController::class, 'index']);
                Route::post('feedback', [FeedbackController::class, 'store']);
                Route::get('provider-company', [ProviderCompanyController::class, 'index']);
                Route::get('vehicle-model', [VehicleModelController::class, 'index']);

                Route::get('user/{id}/desired-location', [UserController::class, 'getDesiredLocation']);
                Route::post('user/{id}/desired-location', [UserController::class, 'setDesiredLocation']);
            });
            // with role provider
            Route::middleware('role:provider')->group(function (){
                Route::get('desired-location', [DesiredLocationController::class, 'index']);
                Route::post('feedback', [FeedbackController::class, 'store']);

                Route::get('user/{id}/provider-company', [UserController::class, 'getProviderCompany']);
                Route::post('user/{id}/provider-company', [UserController::class, 'setProviderCompany']);
            });
        });

    });

});

