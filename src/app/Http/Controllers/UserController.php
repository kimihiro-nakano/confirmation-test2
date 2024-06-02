<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function showRegister()
    {
        $users = User::all();

        return view('auth.register', compact('users'));
    }

    public function register(RegisterRequest $request)
    {
        $registerData = $request->all();
        $registerData['password'] = Hash::make($registerData['password']);
        User::create($registerData);
        return redirect('/login');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $loginData = $request->only('email', 'password');

        $user = User::where('email', $loginData['email'])->first();
        if (Auth::attempt($loginData)) {
            $request->session()->regenerate();
            return redirect('/admin');
        } else {
            return redirect('/login');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }
}
