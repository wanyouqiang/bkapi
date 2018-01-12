<?php

namespace App\Http\Controllers\API;

use BenbenLand\Contracts\Code;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends ApiController
{
    public function login(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ], [
            'username.required' => $this->ruleMsg(Code::E_AUTH_USERNAME_REQUIRED),
            'username.exists' => $this->ruleMsg(Code::E_AUTH_USERNAME_NOTEXIST),
            'password.required' => $this->ruleMsg(Code::E_AUTH_PASSWORD_REQUIRED)
        ]);

        $this->validatorErrors($validator);

        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if (!Auth::attempt($credentials)){
            $this->thrown(Code::E_AUTH_LOGIN_ERROR);
        }

        $client = new Client;
        $response = $client->post(env('APP_URL') . '/oauth/token', [
            'form_params' => [
                'username' => $request->input('username'),
                'password' => $request->input('password'),
                'grant_type' => 'password',
                'client_id' => env('CLIENT_ID'),
                'client_secret' => env('CLIENT_SECRET'),
            ]
        ]);

        return $response;
    }

    public function logout(Request $request)
    {
        try {
            $request->user()->token()->revoke();
            return $this->apiResponse('登录已注销', Code::R_OK);
        } catch (\Exception $e) {
            return $this->exceptionHander($e);
        }
    }
}
