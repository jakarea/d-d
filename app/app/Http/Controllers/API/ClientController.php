<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\User\UpdateRequest;
use App\Models\User;
use App\Process\UserProcess;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
}
