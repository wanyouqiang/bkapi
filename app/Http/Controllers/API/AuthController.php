<?php

namespace App\Http\Controllers\API;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $req = $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);

        $client = new Client;
        $response = $client->post(env('APP_URL') . '/oauth/token', [
            'form_params' => [
                'username' => $req['username'],
                'password' => $req['password'],
                'grant_type' => 'password',
                'client_id' => env('CLIENT_ID'),
                'client_secret' => env('CLIENT_SECRET'),
            ]
        ]);

        return $response;
    }
}
