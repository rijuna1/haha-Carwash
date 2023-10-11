<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function login()
    {
        if(Auth::check()){
            return redirect("home");
        }

        return view("login");
    }

    public function authentication(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        
        $credentials = $request->only('username', 'password');

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended("/home");
        }

        return back()->withInput()->withErrors([
            'login_error' => "Username atau password salah"
        ]);
    }

    public function logout(Request $request)
    {
       $request->session()->flush();
       Auth::logout();
       return Redirect('/');
    }
}
