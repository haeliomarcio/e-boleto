<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request) {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // return redirect()->intended('/dashboard');
            return redirect()->intended('/');
        }
        return redirect('/login');
    }

    public function login() {
        if (Auth::check()) {
            return redirect('dashboard');
        }
        return view('login');
    }

    public function logout() {
        Auth::logout();
        return redirect('login');
    }

}
