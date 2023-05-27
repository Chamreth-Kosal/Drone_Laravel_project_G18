<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\ShowUserResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        $users = UserResource::collection($users);

        return response()->json(['success' =>true, 'data' =>$users],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $users = User::store($request);
        return response()->json(['success' =>true, 'data' =>$users],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $users = User::find($id);

        if(!$users){
            return response()->json(['message' =>'Note Found'],404);
        }

        $users = new ShowUserResource($users);
        return response()->json(['success' =>true, 'data' =>$users],200);
 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $users = User::find($id);

        $users -> update([
            'name'=> $request -> input('name'),
            'email'=> $request -> input('email'),
            'password'=> $request -> input('password'),
        ]);

        return response()->json(['success' =>true, 'data' =>$users],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $users = User::find($id);

        if (! $users){
            return response()->json(['message' => 'Record not found'], 404);
        }
        
        $users->delete();
        return response()->json(['message' => 'Record deleted'], 200);
    }
}
