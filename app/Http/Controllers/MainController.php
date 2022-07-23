<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use GuzzleHttp\Client;

use App\Http\Controllers\Auth;
use App\Http\Controllers\Session;

class MainController extends Controller
{

    public function index(Request $request)
    {
        

        if ($request->submit) {

            $client = new Client([
                'headers' => ['Content-Type' => 'application/json']
            ]);

            $response = $client->post('https://symfony-skeleton.q-tests.com/api/v2/token',[
                'body' => json_encode(['email' => $request->email, "password" => $request->password])
            ]);
            $response = $response->getBody();
            $response = json_decode($response,true);

            if (!empty($response['token_key'])) {
                $request->session()->put('token_key', $response['token_key']);
                $request->session()->put('user_data', $response);
                return redirect('/Author/list');
            }

        } else {

             return view('login.index', $request);

        }
    }

    public function logout(Request $request) {

        \Auth::logout();
        \Session::flush();
        return redirect('/Main/');
    }

}