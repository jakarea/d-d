<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Registration
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(RegistrationRequest $request)
    {
    
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => 'admin',
        ]);

        if ($user) {
            $role = new UserRole();
            $role->user_id = $user->id;
            $role->role_id = 1;
            $role->save();
        }

        return redirect()->route('login')->with('success', 'Registration successful. Please log in.');
    }

    // Login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {

        $credentials = $request->only('email', 'password','remember');

        $remember = $request->boolean('remember');
        if (Auth::attempt($credentials, $remember)) {
            return redirect()->intended('/dashboard');
        }

        return redirect()->route('login')
            ->withInput($request->only('email', 'remember'))
            ->withErrors(['error' => 'Invalid credentials.']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}