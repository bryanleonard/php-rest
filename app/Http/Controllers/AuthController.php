<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Tymon\JWTAuth\Exceptions\JWTException;
// use JWTAuth;

class AuthController extends Controller
{
    public function store (Request $request) 
    {
        return 'auth store works';
    }

    public function signin(Request $request)
    {
        return 'auth signin works';
    }
}
