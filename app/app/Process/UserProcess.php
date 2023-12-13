<?php

namespace App\Process;

use App\Models\Address;
use App\Models\PersonalInfo;
use App\Models\User;
use App\Traits\FileTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

class UserProcess
{
    use FileTrait;

    public static function update(Request $request, $user)
    {
        $user = (new self())->saveUser($request, $user);
        $personalInfo = (new self())->savePersonalInfo($request);
        $address = (new self())->saveAddress($request);

        $userInfo = array_merge($user->toArray(), $personalInfo->toArray(), $address->toArray());

        return $userInfo;
    }

    public function saveUser($request, $user)
    {
        $user->name = $request->first_name . ' ' . $request->last_name;
        $user->email = $request->email;
        $user->save();

        return $user;
    }

    public function savePersonalInfo($request)
    {

        $avatarPath = null;

        $authUser = auth()->user();

        if(isset($request->avatar)){
            $avatarPath = $this->saveAvatar($request->avatar);
            $avatarPath = asset('storage/avatar/' . $avatarPath);
        }

        if(isset($request->avatar) && isset($authUser->personalInfo) && isset($authUser->personalInfo->avatar)){

            $fileUrl = Config::get('app.file_url');
            $image = str_replace($fileUrl, "", $authUser->personalInfo->avatar);

            if (Storage::disk("public")->exists($image)) {
                Storage::disk("public")->delete($image);
            }
        }

        $personalInfo = PersonalInfo::updateOrCreate(
            [
                'user_id' =>  auth()->user()->id,
            ],
            [
                'user_id' => auth()->user()->id,
                'name' => $request->get('first_name') . ' ' . $request->get('last_name'),
                'avatar' => $avatarPath,
                'gender' => $request->get("gender"),
                'designation' => $request->get('designation'),
                'maritual_status' => $request->get('maritual_status'),
                'dob' => $request->get('date_of_birth'),
                'phone' => $request->get('phone'),
                'nationality' => $request->get('nationality'),
                'email' => $request->get('email')
            ],
        );

        return $personalInfo;
    }

    public function saveAddress($request)
    {

        $address = Address::updateOrCreate(
            [
                'user_id' => auth()->user()->id,
            ],
            [
                'user_id' => auth()->user()->id,
                'primary_address' => $request->get("address"),
                'country' => $request->get('country'),
                'city' => $request->get('city'),
                'state' => $request->get('state'),
                'post_code' => $request->get('postcode'),
            ],
        );

        return $address;
    }

    public function saveAvatar($avatar)
    {
        $filePath = $this->fileUpload($avatar, "avatar");

        return $filePath;
    }

}
