<?php

use App\Http\Controllers\DroneController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\DronePlanController;
use App\Http\Controllers\FarmController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Route::resource('/farm', FarmController::class);

// Route::resource('/users', UserController::class);
// Route::get('/users', [UserController::class, 'index']);
// Route::post('/users', [UserController::class, 'store']);

// Route::resource('/drones', DroneController::class);
// Route::get('/drones', [DroneController::class, 'index']);
// Route::post('/drones', [DroneController::class, 'store']);
// Route::get('/drones/{id}', [DroneController::class, 'show']);
// Route::put('/drones/{id}', [DroneController::class, 'update']);
Route::get('/drones/{id}/locations', [DroneController::class, 'locations']);
Route::put('/drones/{id}', [DroneController::class, 'updateStatus']);

// Route::resource('/maps', MapController::class);
// Route::get('/maps', [MapController::class, 'index']);
// Route::post('/maps', [MapController::class, 'store']);
Route::post('/maps/{address}/{farmId}', [MapController::class, 'createImage']);
Route::get('/maps/{address}/{farmId}', [MapController::class, 'downloadImage']);
Route::delete('/maps/{address}/{farmId}', [MapController::class, 'deleteImage']);

// Route::resource('/plans', PlanController::class);
// Route::resource('/locations', LocationController::class);
// Route::get('/locations', [LocationController::class, 'index']);
// Route::post('/locations', [LocationController::class, 'store']);

// Route::get('/locations', [LocationController::class, 'index']);
// Route::resource('/dronePlans', DronePlanController::class);


