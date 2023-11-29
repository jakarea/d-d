<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\User\SecuritySettingRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\User;
use App\Process\UserProcess;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClientController extends ApiController
{
    public function profile()
    {
        $user = User::where('id', auth()->user()->id)->first();

        return $this->jsonResponse(false, $this->success, $user, $this->emptyArray, JsonResponse::HTTP_OK);
    }

    public function profileUpdate(UpdateRequest $request)
    {

        try {
            $user = User::where('id', auth()->user()->id)->first();
            $user = UserProcess::update($request, $user);

            return $this->jsonResponse(false, 'Profile updated successfully', $user, $this->emptyArray, JsonResponse::HTTP_CREATED);
        } catch (\Exception $e) {
            return $this->jsonResponse(true, 'Failed to update profile', $request->all(), [$e->getMessage()], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function securitySettings(SecuritySettingRequest $request)
    {

        try {
            $user = User::where('id', auth()->user()->id)->first();
            $user->email = $request->email;
//            $user->phone = $request->phone;
            $user->password = Hash::make($request->password);
            $user->save();

            return $this->jsonResponse(false, $this->success, $user, $this->emptyArray, JsonResponse::HTTP_CREATED);

        } catch (\Exception $e) {
            return $this->jsonResponse(true, $this->failed, $request->all(), [$e->getMessage()], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
