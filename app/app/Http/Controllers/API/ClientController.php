<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ClientController extends ApiController
{
    public function profile()
    {
        $user = User::where('id', auth()->user()->id)->first();

        return $this->jsonResponse(false, $this->success, $user, $this->emptyArray, JsonResponse::HTTP_OK);
    }
}
