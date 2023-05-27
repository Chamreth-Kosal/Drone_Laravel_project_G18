<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePlanRequest;
use App\Http\Resources\PlaneResource;
use App\Http\Resources\ShowPlaneResource;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $plans = Plan::all();
        // $plan = request('name');
        // $plans = Plan::where('name', 'like', '%'. $plan. '%')->get();
        
        $plans = PlaneResource::collection($plans);
        return response()->json(['success' => true, 'data' => $plans], 200);
    }

    public function getPlanName(Request $request){
        $plans = Plan::all();
        $plan= $request->get('name');
        $plans = Plan::where('name', 'like', '%' .$plan. '%')->get();
        return response()->json(['success' =>true, 'data' =>$plans],201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePlanRequest $request)
    {
        $plan = Plan::store($request);
        return response()->json(['success' => true, 'data' => $plan], 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $plan = Plan::find($id);
        $plan = new ShowPlaneResource($plan);
        return response()->json(['success' => true, 'data' => $plan], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePlanRequest $request, string $id)
    {
        $plan = Plan::store($request, $id);
        return response()->json(['success' => true, 'data' => $plan], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $plan = Plan::find($id);
        if (! $plan){
            return response()->json(['message' => 'Record not found'], 404);
        }
        $plan->delete();
        return response()->json(['message' => 'Record deleted'], 200);
    }
}
