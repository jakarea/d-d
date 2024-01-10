<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\User\SecuritySettingRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\Notification;
use App\Models\PersonalInfo;
use App\Models\User;
use App\Process\UserProcess;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class NotificationController extends ApiController
{
    public function clientNotifyList():JsonResponse
    {
        $notifications = Notification::with(['creator.personalInfo', 'receiver.personalInfo', 'product'])
        ->where('status', 1)
        ->where('role', 'like', '%client%')
        ->orWhere('receiver_id',auth()->user()->id)
        ->get(); 

        if (!empty($notifications)) {

            return $this->jsonResponse(false, $this->success, $notifications, $this->emptyArray, JsonResponse::HTTP_OK);
        } else {

            return $this->jsonResponse(true, $this->failed, $this->emptyArray, ['Notification not found!'], JsonResponse::HTTP_NOT_FOUND);
        }
       
    }
    
    public function companyNotifyList():JsonResponse
    {
        $notifications = Notification::with(['creator', 'receiver', 'product'])
        ->where('status', 1)
        ->where('role', 'like', '%company%')
        ->orWhere('receiver_id',auth()->user()->id)
        ->get(); 

        if (!empty($notifications)) {

            return $this->jsonResponse(false, $this->success, $notifications, $this->emptyArray, JsonResponse::HTTP_OK);
        } else {

            return $this->jsonResponse(true, $this->failed, $this->emptyArray, ['Notification not found!'], JsonResponse::HTTP_NOT_FOUND);
        }

        
    }
    public function seen():JsonResponse
    {
        $notifications = Notification::where('status', 1)
        ->where('receiver_id', auth()->user()->id)
        ->get();

        $notifications->each(function ($notification) {
            $notification->update(['status' => 0]);
        });

        return $this->jsonResponse(false, "Notification Seen Success!", $notifications, $this->emptyArray, JsonResponse::HTTP_OK);
    }
 
}
