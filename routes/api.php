<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('{controller}/{action?}/{user_id?}/{id?}', function($controller,$action = 'show',$user_id = null,$id = null) {
    
    //return [$controller,$action,$user_id,$id];
    if ($controller) {

        $namespace = "\App\Http\Controllers\API\\";
        $controller = $namespace.$controller.'Controller@'.$action;
        return App::call($controller,[
            'id' => $id,
            'user_id' => $user_id
        ]); 
    
    }
    
});

Route::post('{controller}/{action?}/{user_id?}/{id?}', function($controller,$action = 'show',$user_id = null,$id = null) {
    
    //return [$controller,$action,$user_id,$id];
    if ($controller) {

        $namespace = "\App\Http\Controllers\API\\";
        $controller = $namespace.$controller.'Controller@'.$action;
        return App::call($controller,[
            'id' => $id,
            'user_id' => $user_id
        ]); 
    
    }
    
});