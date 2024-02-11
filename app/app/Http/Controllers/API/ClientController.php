<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\User\SecuritySettingRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\PersonalInfo;
use App\Models\PricingPackage;
use App\Models\User;
use App\Process\UserProcess;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClientController extends ApiController
{
    public function profile():JsonResponse
    {
        $user = User::with(['personalInfo','company','address'])->where('id', auth()->user()->id)->first();
        $package = NULL;
        if ($user->payments) {
            $package = PricingPackage::where('id',$user->payments->pricing_packages_id)->first();
        }

        $userInfo = [
            'user_info' => $user, 
            // 'user_company' => $user->company,
            'current_package_info' => [
                'is_expired' => optional($user->payments)->end_at > now() ? 0 : 1,
                'package' => $package,
                'payment_info' => $user->payments
            ]
        ];


        return $this->jsonResponse(false, $this->success, $userInfo, $this->emptyArray, JsonResponse::HTTP_OK);
    }

    public function profileUpdate(Request $request):JsonResponse
    { 
        try { 

            $creds = $request->validate([
                'first_name' => 'required|min:2|max:100',
                'last_name' => 'required|min:2|max:155',
                'date_of_birth' => 'required|date_format:Y-m-d',
                'email' => [
                    'required',
                    'email',
                    'regex:/(.+)@(.+)\.(.+)/i',
                    'unique:users,email,' . auth()->user()->id,
                    'max:255'
                ],
                'phone' => 'required|numeric',
                'address' => 'required|min:5',
                'postcode' => 'required|numeric|digits:4',
                'country' => 'required',
                'avatar' => 'nullable|string',
            ]);
            
            $user = User::where('id', auth()->user()->id)->first();

            $user = UserProcess::update($request, $user, $creds);  

            return $this->jsonResponse(false, 'Profile updated successfully', $user, $this->emptyArray, JsonResponse::HTTP_CREATED);
        } catch (\Exception $e) {

            $errors = $e->getMessage();

            return $this->jsonResponse(true, 'Failed to update profile', $request->all(), [$errors], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function securitySettings(SecuritySettingRequest $request):JsonResponse
    {

        // return response()->json(1234567);

        try {
            $user = User::where('email', $request->email)->first();

            if(!$user){
                return $this->jsonResponse(true, 'Email does not match to our record', $request->all(), ['email' => ['Email not found!']], 404);
            }

            $request->validate([
                'password' => [
                    'required',
                    'min:8',
                    'regex:/^(?=.*[a-zA-Z])(?=.*\d)/',
                ],
            ], [
                'password.regex' => 'Ensure that the password contains at least one letter and one number.',
            ]);

            if ($user->email === $request->email) {
                
                $user->password = Hash::make($request->password); 
                $user->save();

                $personalInfo = PersonalInfo::updateOrCreate(
                    [
                        'user_id' => $user->id,
                    ],
                    [
                        'name' =>  $user->name,
                        'phone' => $request->get('phone'),
                        'email' => $user->email
                    ],
                );

                $userInfo = array_merge($user->toArray(), $personalInfo->toArray());

                return $this->jsonResponse(false, $this->success, $userInfo, $this->emptyArray, JsonResponse::HTTP_CREATED);
            }else{
                return $this->jsonResponse(true, 'Email does not match to our record', $request->all(), ['email' => ['Email not found!']], 404);
            }

        } catch (\Exception $e) {
            return $this->jsonResponse(true, $this->failed, $request->all(), [$e->getMessage()], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function deleteAccount($user_id)
    {
        if (!$user_id) {
            return $this->jsonResponse(true, 'User not found!', $user_id, $this->emptyArray, JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }

        $user = User::find($user_id);
        $user->status = null;
        $user->save();

        return $this->jsonResponse(false, 'Profile deleted successfully', $user, $this->emptyArray, JsonResponse::HTTP_CREATED);
    }
}
