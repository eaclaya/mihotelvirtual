<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function postLogin(PostLoginRequest $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect('dashboard')->with('success', 'Bienvenido ' . auth()->user()->name);
        }
        return redirect('login')->with('failed', 'Credenciales incorrectas');
    }

    public function logout()
    {
        $name = auth()->user()->name;
        Auth::logout();
        return redirect('login')->with('success', 'Session terminada ' . $name);
    }
}
