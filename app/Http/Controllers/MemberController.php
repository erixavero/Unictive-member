<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    

    public function index()
    {
        try{
        $members = User::paginate(10);
        return response()->json([
            'data'=> $members
        ]);
        }catch (QueryException $e) {
            return response()->json(['error' => "it screwed up"], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $member = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone
        ]);
        return response()->json([
            'data'=> $member
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $member
     * @return \Illuminate\Http\Response
     */
    public function show(User $member)
    {
        try{
        return response()->json([
            'data'=> $member,
            'hobbies' => $member->hobbies
        ]);
        }catch (QueryException $e) {
            return response()->json(['error' => "it screwed up"], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $member)
    {
        try{
        $member->name =  $request->name;
        $member->email =  $request->email;
        $member->phone =  $request->phone;
        $member->save();
        return response()->json([
            'data' => $member
        ]);
        }catch (QueryException $e) {
            return response()->json(['error' => "it screwed up"], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $member)
    {
        try{
        $User->delete();
        return response()->json([
            'data' => 'deleted'
        ], 204);
        }catch (QueryException $e) {
            return response()->json(['error' => "it screwed up"], 404);
        }
    }
}
