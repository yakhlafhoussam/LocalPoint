<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    public function submitLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->role === 'admin') {
                return redirect()->route('home');
            }

            return redirect()->route('home');
        }
        return back()->withErrors([
            'email' => 'Email ou mot de passe incorrect .'
        ])->onlyInput('email');
    }

    public function register()
    {
        return view('auth.signup');
    }

    public function submitRegister(Request $request)
    {
        $request->validate([
            'first' => 'required|min:3',
            'last' => 'required|min:3',
            'city' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->first . ' ' . $request->last,
            'city' => $request->city,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
