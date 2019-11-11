<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');


        if (auth()->attempt($credentials)) {

            $user = auth()->user()->toArray();

            return array_only($user, ['id', 'name', 'api_token']);
        }

        return response()->json(['error' => 'Usuário ou senha não encontrados'], 200);
    }
}
