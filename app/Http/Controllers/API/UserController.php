<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Users = new User;

        $Users->name       = $request->name;
        $Users->password       = Hash::make($request->password);
        $Users->email  = $request->email;
        $Users->email_verified_at  = now();
        $Users->remember_token = Str::random(10);

        try {
            $response = $Users->save();

            $response = User::where([
                'email' => $request->email,
            ])->get();

            return [
                'status' => true,
                'data'   => $response[0]
            ];

        } catch(\Illuminate\Database\QueryException $ex){
     
            return [
                'status' => false,
                'message' => $ex->getMessage()
            ]; 
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::all();
    }


    public function detail($user_id)
    {
        return User::find($user_id);
    }


    public function login(Request $request)
    {
        
        $response = User::where([
            'email' => $request->email,
        ])->get();
        
        if(Hash::check($request->password,$response[0]['password'])) {
            return [
                'status' => true,
                'data'  => $response[0]
            ];
        }

        return [
            'status' => false
        ];


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user_id)
    {

        $Users = User::find($request->user_id);
        $Users->name       = $request->name ?? $Users->name;
        $Users->email       = $request->email ?? $Users->email;
        $Users->password       = $request->password ? Hash::make($request->password) : $Users->password;

        try {
            $response = $Users->save();

            return [
                'status' => $response,
                'data'  => $Users
            ];

        } catch(\Illuminate\Database\QueryException $ex){
            return [
                'status' => false,
                'message' => $ex->getMessage()
            ]; 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
