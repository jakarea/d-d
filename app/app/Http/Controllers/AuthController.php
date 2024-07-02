<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use App\Mail\VerificationMail;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
            $role->role_id = 3;
            $role->save();

            $company = Company::create([
                'name' => $user->name,
                'email' => $user->email,   
                'user_id' => $user->id
            ]);

            // Log the user in
            Auth::login($user);
        }

        $newVerificationCode = str_pad(mt_rand(0, 99999), 5, '0', STR_PAD_LEFT);
        $user->update(['verification_code' => $newVerificationCode]);
        $this->sendVerificationEmail($user, $newVerificationCode);

        return redirect('/verify-email/'.$user->id . '/'. $newVerificationCode)->with('success', 'Registration successful done! please verify to continue.');
 
    }

    // Login
    public function showLoginForm()
    {
        return view('auth.login');
    }

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

        Auth::login($user);

        // if auth user is admin then redirect to dashboard
        $remember = $request->boolean('remember');
        $roles = $user->roles->pluck('slug')->all();
        if (Auth::attempt($credentials, $remember)) {
            if (in_array('admin', $roles)) {
                return redirect()->intended('/analytics');
            }
        }

        // Check if the account is already verified
        if ($user->email_verified_at) {
            return redirect('/')->with('success', 'Login Success!');
        }else{

            $newVerificationCode = str_pad(mt_rand(0, 99999), 5, '0', STR_PAD_LEFT);
            $user->update(['verification_code' => $newVerificationCode]);
            $this->sendVerificationEmail($user, $newVerificationCode);
    
            return redirect('/verify-email/'.$user->id . '/'. $user->verification_code)->with('success', 'Please verify to continue.');
        }

        
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    // send email for verify
    protected function sendVerificationEmail(User $user, $verificationCode)
    {
        // Use your email template and customize as needed
        Mail::to($user->email)->send(new VerificationMail($user, $verificationCode));
    }
}
