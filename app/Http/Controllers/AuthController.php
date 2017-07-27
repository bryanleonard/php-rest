<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

class AuthController extends Controller
{
	// create a new user
	public function store(Request $request)
	{
		$name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');

        $user = [
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'signin' => [
                'href' => 'api/v1/user/signin',
                'method' => 'POST',
                'params' => 'email, password'
            ]
        ];

        $response = [
            'msg' => 'User created',
            'user' => $user
        ];

        return response()->json($response, 201);
	}

	public function signin(Request $request)
	{
		$email = $request->input('email');
        $password = $request->input('password');
        $user = [
            'name' => 'Name',
            'email' => $email,
            'password' => $password
        ];

        $response = [
            'msg' => 'User signed in',
            'user' => $user
        ];

        return response()->json($response, 200);
	}
}
