<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLocationRequest;
use App\Http\Resources\ShowLocationResource;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locations = Location::all();
        $locations = ShowLocationResource::collection($locations);
        return response()->json(['success' =>true, 'data' =>$locations],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLocationRequest $request)
    {
        $locations = Location::store($request);
        return response()->json(['success' =>true, 'data' =>$locations],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $locations =Location::find($id);
        $locations=new ShowLocationResource($locations);
        return response()->json(['success' =>true, 'data' =>$locations],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $locations = Location::store($request, $id);
        return response()->json(['success' => true, 'data' => $locations], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}