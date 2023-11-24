<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    protected function jsonResponse($errorCode, $message, $data, $errors = [], $status = 200)
    {
        return response()->json([
            'error' => $errorCode,
            'message' => $message,
            'data' => $data,
            'errors' => $errors,
        ], $status);
    }
}