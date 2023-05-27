<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMapRequest;
use App\Http\Resources\FarmResource;
use App\Http\Resources\ShowMapResource;
use App\Models\Drone;
use App\Models\Farm;
use App\Models\Map;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $maps = Map::all();
        $maps = ShowMapResource::collection($maps);
        return response()->json(['success' =>true, 'data' =>$maps],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMapRequest $request)
    {
        $maps = Map::store($request);
        return response()->json(['success' =>true, 'data' =>$maps],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $map = Map::all();
        $map = ShowMapResource::collection($map);
        return response()->json(['success' =>true, 'data' =>$map],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteImage(Request $image,$address,$farmId)
    {
        $farm = Farm::where('id',$farmId)->firstOrFail();
        // $map = Map::where('address', $address)->firstOrFail();

        if (!$farm) {
            return response()->json(['message' => 'Farm id not found']);
        }

        $map = Map::where('address', $address)
        ->whereHas('farms', function ($query) use ($farm) {
            $query->where('id', $farm->id);
        })->first();

        if ($map) {
            $map->images = null;
            $map->save();
            return response()->json(['status'=>true,'image'=>$map]);
        }
        return response()->json(['message' => 'Map id not found']);

    }

    ## Download map photo the drone took of KC Farm #7
    public function downloadImage(Request $image,$address,$farmId)
    {
        $farm = Farm::where('id',$farmId)->firstOrFail();
        if (!$farm) {
            return response()->json(['message' => 'Farm id not found']);
        }

        $map = Map::where('address', $address)
        ->whereHas('farms', function ($query) use ($farm) {
            $query->where('id', $farm->id);
        })->first();

        if ($map) {
            return response()->json(['status'=>true,'image'=>$map->images]);
        }
        return response()->json(['message' => 'Map id not found']);

    }

    // ====Add a newly taken mapping image for farm 7 in Kampong Cham====
     
    public function createImage(Request $image,$address,$farmId){
        $farm = Farm::where('id', $farmId)->first();
        if (!$farm) {
            return response()->json(['message' => 'Farm id not found']);
        }
    
        $map = Map::where('address', $address)
        ->whereHas('farms', function ($query) use ($farm) {
                $query->where('id', $farm->id);
        })->first();
    
        if ($map) {
        $map->images = request('images');
        $map->save();
        return response()->json(['status'=>true,'image'=>$map]);
        }
        return response()->json(['message' => 'Map id not found']);
    }
}

