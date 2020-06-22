<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function self() {
        return user();
    }

    function signup() {
        $data = [
            'email' => request('email'),
            'password' => request('password'),
        ];
        $rules = [
            'email' => 'required|email|unique:users',
            'password' => 'required|string',
        ];

        validate($data, $rules);
        $user = User::create($data);
        return [
            'user' => $user,
            'token' => $user->createSession()->token,
        ];
    }

    function login() {
        $user = User::where('email', request('email'))->firstOrFail();
        if (!$user->hasPassword((string) request('password'))) abort(401);
        return [
            'user' => $user,
            'token' => $user->createSession()->token,
        ];
    }

    function logout() {
        $session = user()->sessions()->where('token', http_token())->firstOrFail();
        $session->delete();
        return $session->token;
    }
}
