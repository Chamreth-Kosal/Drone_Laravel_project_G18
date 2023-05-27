<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDroneRequest;
use App\Http\Resources\DroneResource;
use App\Http\Resources\ShowDroneResource;
use App\Http\Resources\ShowLocationResource;
use App\Models\Drone;
use App\Models\Map;
use Illuminate\Http\Request;
use Psy\Readline\Hoa\Console;

class DroneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $drones = Drone::all();
        $drones = DroneResource::collection($drones);

        return response()->json(['success' => true, 'data' => $drones], 200);
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
        $drone = Drone::where('drone_id', $id)->first();;

        if (! $drone){
            return response()->json(['message' => 'drone id not found'], 404);
        }

       $drone = new ShowDroneResource($drone);
        return response()->json(['success' => true, 'date' => $drone], 200);
    }


    // Update the system of current status (battery, payload, location etc)
    public function updateStatus(Request $request, $id){
        $drone = Drone::where('drone_id', $id)->first();

        if (!$drone) {
            return response()->json(['message' => 'Drone not found'], 404);
        }

        $drone->battery = $request->input('battery');
        $drone->payload = $request->input('payload');
        $drone->save();

        return response()->json(['success' => true, 'data' => $drone], 201);
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

    public function locations($id){

        $drone = Drone::where('drone_id', $id )->first();

        if(! $drone){
            return response()->json(['message' => 'Drone id not found'], 404);
        }
        
        $location = $drone->locations;
        return response()->json(['success' => true, 'data' => $location], 200);
    }
}
