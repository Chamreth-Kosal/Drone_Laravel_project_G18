<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDronePlanRequest;
use App\Models\DronePlan;
use Illuminate\Http\Request;

class DronePlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dronPlan = DronePlan::all();

        return response()->json(['success' => true, 'data' => $dronPlan], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDronePlanRequest $request)
    {
        $dronePlan = DronePlan::store($request);

        return response()->json(['success' => true, 'data' => $dronePlan], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
