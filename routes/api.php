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
    // public routes
    Route::post('login', [LoginController::class, 'login']);
    Route::post('logout', [LoginController::class, 'logout']);

    // private routes
    Route::middleware('auth:sanctum')->group(function (){
        Route::get('/user', function (Request $request) {
            return $request->user();
        });
        Route::apiResource('brand', BrandController::class);
        Route::apiResource('chargertype', ChargerTypeController::class);
        Route::apiResource('desired-location', DesiredLocationController::class);
        Route::apiResource('feedback', FeedbackController::class);
        Route::apiResource('provider-company', ProviderCompanyController::class);
        Route::apiResource('user', UserController::class);
        Route::apiResource('vehicle-model', VehicleModelController::class);
    });

});

