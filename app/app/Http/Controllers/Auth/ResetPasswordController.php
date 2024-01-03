<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use App\Models\InstructorModuleSetting;
use App\Providers\RouteServiceProvider; 

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    // use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function showResetForm(Request $request, $token = null)
    {
        $email = $request->email; 
        
        return view('auth.password.web-reset-password', compact('email','token'));
    }

    public function showSuccessPage()
    { 
        return view('auth.password.status.web.success');
    }

    public function showFailPage()
    { 
        return view('auth.password.status.web.cancel');
    }

    // forgot passowrd email page dashboard
    public function showLinkRequestForm()
    { 
        return view('auth.password.email');
    }

    public function sendResetLinkEmail(Request $request)
    { 
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) { 
            return redirect()->back()->with('success', trans($status));

        } else {
            return redirect()->back()->with('error', trans($status));
        }
    }
}
