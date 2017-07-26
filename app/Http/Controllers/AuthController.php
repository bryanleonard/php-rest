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

		return 'store works';
	}

	public function signin(Request $request)
	{
		$email = $request->input('email');
        $password = $request->input('password');

        return 'signin works';
	}
}
