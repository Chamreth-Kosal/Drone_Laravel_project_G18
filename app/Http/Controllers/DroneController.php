<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDroneRequest;
use App\Models\Drone;
use Illuminate\Http\Request;

class DroneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $drone = Drone::all();

        return response()->json(['success' => true, 'data' => $drone], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDroneRequest $request)
    {
        $drone = Drone::store($request);

        return response()->json(['success' => true, 'data' => $drone], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $drone = Drone::find($id);
       
        return response()->json(['success' => true, 'date' => $drone], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreDroneRequest $request, string $id)
    {
        $drone = Drone::store($request, $id);
        return response()->json(['success' => true, 'data' => $drone], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $drone = Drone::find($id);
        
        if (! $drone){
            return response()->json(['message' => 'Record not found'], 404);
        }

        $drone->delete();
        return response()->json(['message' => 'Record deleted'], 200);
    }
}
