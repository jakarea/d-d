<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\User\SecuritySettingRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\PersonalInfo;
use App\Models\PricingPackage;
use App\Models\User;
use App\Process\UserProcess;
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
                'package' => $package,
                'payment_info' => $user->payments
            ]
        ];

        return $this->jsonResponse(false, $this->success, $userInfo, $this->emptyArray, JsonResponse::HTTP_OK);
    }

    public function profileUpdate(UpdateRequest $request):JsonResponse
    {

        try {
            $user = User::where('id', auth()->user()->id)->first();

            $user = UserProcess::update($request, $user); 

            // return response()->json(['data' => $user]);

            return $this->jsonResponse(false, 'Profile updated successfully', $user, $this->emptyArray, JsonResponse::HTTP_CREATED);
        } catch (\Exception $e) {
            return $this->jsonResponse(true, 'Failed to update profile', $request->all(), [$e->getMessage()], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function securitySettings(SecuritySettingRequest $request):JsonResponse
    {

        try {
            $user = User::where('id', auth()->user()->id)->first();

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
                        'user_id' => auth()->user()->id,
                    ],
                    [
                        'name' =>  auth()->user()->name,
                        'phone' => $request->get('phone'),
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
}
