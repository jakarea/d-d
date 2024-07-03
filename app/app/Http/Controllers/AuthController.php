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
use App\Models\PricingPackage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    // Registration
    // rediect user if they do not choice package or invalid package
    public function redirectRegister(){
        return redirect('pricing')->with('warning','You need to choice a package first');
    }

    public function showRegistrationForm($encrypted_package_id, $encrypted_package_price, $encrypted_package_type)
    {

        if (!$encrypted_package_id || !$encrypted_package_price || !$encrypted_package_type) {
            return redirect('pricing')->with('warning','You need to choice a package first');
        }

        return view('auth.register', compact('encrypted_package_id', 'encrypted_package_price', 'encrypted_package_type'));
    }

    public function register(RegistrationRequest $request)
    {

        // Retrieve the parameters
        $package_id = decrypt($request->route('package_id'));
        $package = PricingPackage::where('id', $package_id)->first();

        if (!$package) {
            return redirect('/')->with('error', 'No Package Found');
        }

        $package_price = decrypt($request->route('package_price'));
        $package_type = decrypt($request->route('package_type'));

        // Create user
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'email_verified_at' => now(),
        ]);

        if ($user) {
            // Create company
            $role = new UserRole();
            $role->user_id = $user->id;
            $role->role_id = 3;
            $role->save();

            $company = Company::create([
                'name' => $user->name,
                'email' => $user->email,
                'user_id' => $user->id,
                'email_verified_at' => now(),
            ]);

            Auth::login($user);

            // Retrieve the authenticated user's token (assuming Sanctum)
            $token = $user->createToken('auth_token')->plainTextToken;

            // Prepare data for the API call to Stripe
            $data = [
                '_token' => csrf_token(),
                'package_id' => $package_id,
                'price' => $package_price,
                'package_type' => $package_type,
                'user_id' => $user->id,
            ];

            // Make the API call to Stripe or redirect to the Stripe page
           $response = Http::withToken($token)->post(url('api/company/purchase/request'), $data);

            // Handle the response from Stripe
            if ($response->successful() && isset($response->json()['data'])) {
                return redirect($response->json()['data']);
            } else {
                return redirect('/')->with('error', 'Failed to process payment.');
            }
        }

        return redirect('/')->with('error', 'Registration failed.');
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
            return redirect()->route('login')->with('error', 'Invalid Credentials');
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

        return redirect('/')->with('success', 'Login Success!');

        // Check if the account is already verified
        // if ($user->email_verified_at) {
        //     return redirect('/')->with('success', 'Login Success!');
        // } else {

        //     $newVerificationCode = str_pad(mt_rand(0, 99999), 5, '0', STR_PAD_LEFT);
        //     $user->update(['verification_code' => $newVerificationCode]);
        //     $this->sendVerificationEmail($user, $newVerificationCode);

        //     return redirect('/verify-email/' . $user->id . '/' . $user->verification_code)->with('success', 'Please verify to continue.');
        // }
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
