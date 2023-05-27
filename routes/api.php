<?php

use App\Http\Controllers\AuthenticationController;
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

// ===========================Farm================================
Route::get('/farm', [FarmController::class, 'index']);
Route::get('/farm/{id}', [FarmController::class, 'show']);

// ===========================User================================
Route::get('/users', [UserController::class,'index']);
Route::post('/users',[UserController::class,'store']);
Route::get('/users/{id}',[UserController::class,'show']);
Route::put('/users/{id}',[UserController::class,'update']);
Route::delete('/users/{id}',[UserController::class,'destroy']);
Route::post('/users',[AuthenticationController::class,'users']);

//=============================Map=================================
Route::get('/maps', [MapController::class,'index']);
Route::get('/maps/{id}',[MapController::class,'show']);
Route::get('/maps/{address}/{farmId}', [MapController::class, 'downloadImage']);

// ==============================Plan===============================
Route::get('/plans', [PlanController::class,'index']);
Route::get('/plans/{id}',[PlanController::class,'show']);
Route::get('/getPlanName', [PlanController::class,'getPlanName']);

// ==============================Drones==============================
Route::get('/drones', [DroneController::class,'index']);
Route::get('/drones/{id}',[DroneController::class,'show']);
Route::get('/drones/{id}/locations', [DroneController::class, 'locations']);

// ==============================Locations=============================
Route::get('/locations', [LocationController::class,'index']);
Route::get('/locations/{id}',[LocationController::class,'show']);

// =============================DronePlan================================
Route::get('/dronePlans', [DronePlanController::class,'index']);
Route::get('/dronePlans/{id}',[DronePlanController::class,'show']);

// =============================Loin======================================
Route::post('/login', [AuthenticationController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {

    // =============================Farm================================
    Route::post('/farm', [FarmController::class, 'store']);

    // ==========================Map=======================================
    Route::post('/maps',[MapController::class,'store']);
    Route::post('/maps/{address}/{farmId}', [MapController::class, 'createImage']);
    // Route::put('/maps/{id}',[MapController::class,'update']);
    Route::delete('/maps/{address}/{farmId}', [MapController::class, 'deleteImage']);
    // Route::delete('/maps/{id}',[MapController::class,'destroy']);
    
    // ============================Plan=====================================
    Route::post('/plans',[PlanController::class,'store']);
    Route::put('/plans/{id}',[PlanController::class,'update']);
    Route::delete('/plans/{id}',[PlanController::class,'destroy']);

    // ============================Location==================================
    Route::post('/locations',[LocationController::class,'store']);
    Route::put('/locations/{id}',[LocationController::class,'update']);
    Route::delete('/locations/{id}',[LocationController::class,'destroy']);

    // ============================Drone=====================================
    Route::post('/drones',[DroneController::class,'store']);
    // Route::put('/drones/{id}',[DroneController::class,'update']);
    Route::put('/drones/{id}', [DroneController::class, 'updateStatus']);
    Route::delete('/drones/{id}',[DroneController::class,'destroy']);

    // ==============================DronePlan=================================
    Route::post('/dronePlans',[DronePlanController::class,'store']);
    Route::put('/dronePlans/{id}',[DronePlanController::class,'update']);
    Route::delete('/dronePlans/{id}',[DronePlanController::class,'destroy']);

    // ===============================Logout=======================================
    Route::post('/logout', [AuthenticationController::class, 'logout']);
});
