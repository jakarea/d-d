<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Illuminate\Support\Facades\Password;
use App\Process\UserProcess;
use Illuminate\Http\JsonResponse; 
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends ApiController
{
    // send link
    public function forgotPassword(Request $request)
    {
        try {
            $request->validate(['email' => 'required|email']);

            $status = Password::sendResetLink(
                $request->only('email')
            );

            if ($status === Password::RESET_LINK_SENT) { 
                return $this->jsonResponse(false, __($status), $request->all(), $this->emptyArray,JsonResponse::HTTP_OK);
            } else {
                throw ValidationException::withMessages([
                    'email' => [trans($status)],
                ]);
            }
        } catch (\Exception $e) {
            return $this->jsonResponse(true, $this->failed, $request->all(), [$e->getMessage()], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    } 

    public function showResetForm(Request $request, $token)
    {
        $email = $request->email; 
        
        return view('auth.password.reset-password', compact('email','token'));
    }


    // set password
    public function resetPassword(Request $request)
    { 

        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => [
                'required',
                'min:8',
                'regex:/^(?=.*[a-zA-Z])(?=.*\d)/',
            ],
            'password_confirmation' => 'required|same:password',
        ], [
            'password.regex' => 'Ensure that the password contains at least one letter and one number.',
        ]);
    
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            return redirect()->route('password.status')->with('success', 'DONE');
        } else {
            return redirect()->route('password.status')->with('error', 'FAILED');
        }
    }

    public function showStatusPage()
    { 
        return view('auth.password.password-status');
    }
}