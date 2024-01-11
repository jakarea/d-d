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
            'password' => Hash::make($request->input('password'))
        ]);

        if ($user) {
            $role = new UserRole();
            $role->user_id = $user->id;
            $role->role_id = 1;
            $role->save();
        }

        return redirect('/')->with('success', 'Registration successful done!.');
    }

    // Login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // public function login(LoginRequest $request)
    public function login(Request $request)
    {

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $user = User::where('email', $credentials['email'])->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return redirect()->route('login')->with('error','Invalid Credentials');
        }

        $containsAdminRole = $user->roles->contains('slug', 'admin');
        if (!$containsAdminRole) {
            return redirect()->route('login')->with('error','Only Admin can login to web dashboard!');
        }

        $remember = $request->boolean('remember');
        if (Auth::attempt($credentials, $remember)) {
            return redirect()->intended('/analytics');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}