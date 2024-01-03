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

    public function showResetForm(Request $request, $token = null)
    {
        $email = $request->email; 

        $role = NULL;

        if ($email) {
            $user = User::where('email',$email)->first();
            $role = $user->roles[0]->slug;
        }

        if ($role == 'admin') {
            return view('auth.password.web-reset-password', compact('email','token'));
        }else{
            return view('auth.password.reset-password', compact('email','token'));
        }
         
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

        $u_email = $request->email; 

        $u_role = NULL;

        if ($u_email) {
            $user = User::where('email',$u_email)->first();
            $u_role = $user->roles[0]->slug;
        }

        if ($status === Password::PASSWORD_RESET) {

            if ($u_role == 'admin') {
                return redirect()->route('admin.password.success')->with('success', trans($status));
            }else{
                return redirect()->route('password.success')->with('success', trans($status));
            }
            
        } else {

            if ($u_role == 'admin') {
                return redirect()->route('admin.password.cancel')->with('error', trans($status));
            }else{
                return redirect()->route('password.cancel')->with('error', trans($status));
            }
        }
    }    

    public function showSuccessPage()
    { 
        return view('auth.password.status.success');
    }

    public function showFailPage()
    { 
        return view('auth.password.status.cancel');
    }
}