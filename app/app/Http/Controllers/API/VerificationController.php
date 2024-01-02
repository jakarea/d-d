<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Models\Company;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationMail;

class VerificationController extends ApiController
{
    public function verify($user_id, $code)
    {
        //$user_id = Crypt::decrypt($user_id);
        try {
            $user = User::where('id', $user_id)->first();
            if ($user->verification_code === $code && !$user->email_verified_at) {
                // Verification successful
                $user->update([
                    'email_verified_at' => now(),
                    'verification_code' => null,
                    'status' => 1,
                ]);

                $roles = $user->roles->pluck('slug')->all();
                $plainTextToken = $user->createToken('hydra-api-token', $roles)->plainTextToken;
         
                $company = Company::where('user_id',$user->id)->first();  
                
                $userInfo = [
                    'token' => $plainTextToken,
                    'user_info' => $user,
                    'user_company' => $company,
                    'current_package' => NULL
                ];

                return $this->jsonResponse(false, 'Verification Success!', $userInfo, $this->emptyArray, JsonResponse::HTTP_CREATED);
            }

            return $this->jsonResponse(1, 'Invalid verification code or user not found.', [], 422);
        } catch (ValidationException $e) {
            return $this->jsonResponse(2, 'Validation error', $e->validator->errors(), 422);
        }
    }

    public function resend($user_id)
    {
        //$user_id = Crypt::decrypt($user_id);
        $user = User::where('id', $user_id)->first();

        // Check if the account is already verified
        if ($user->email_verified_at) {
            return $this->jsonResponse(1, 'Account is already verified.', [],[], 422);
        }

        try {
            // Generate a new verification code
            $newVerificationCode = str_pad(mt_rand(0, 99999), 5, '0', STR_PAD_LEFT);

            // Update the user's verification code in the database
            $user->update(['verification_code' => $newVerificationCode]);

            // Send the new verification code to the user's email
            $this->sendVerificationEmail($user, $newVerificationCode);

            return $this->jsonResponse(0, 'Verification code resent successfully.');
        } catch (\Exception $e) {
            return $this->jsonResponse(2, 'Error resending verification code.', [],[], 500);
        }
    }

    protected function sendVerificationEmail(User $user, $verificationCode)
    {
        // Use your email template and customize as needed
        Mail::to($user->email)->send(new VerificationMail($user,$verificationCode));
    }
}
