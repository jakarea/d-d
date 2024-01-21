<?php

namespace App\Process;

use App\Models\Address;
use App\Models\Company;
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
        $user->name = $request->input('first_name') . ' ' . $request->input('last_name');
        $user->email = $request->input('email');
        $user->kvk_number = $request->input('kvk_number');
        $user->apple_id = $request->input('apple_id');
        $user->save();

        return $user;
    }

    public function savePersonalInfo($request)
    {
        $authUser = auth()->user();

        if (isset($request->avatar) && isset($authUser->personalInfo->avatar)) {
            (new self())->deleteImage($authUser->personalInfo->avatar);
        }

        $imageString = $authUser->personalInfo ? $authUser->personalInfo->avatar : null;

        if (isset($request->avatar)) {
            $imageString = $this->saveImage($request);
        }

        $personalInfo = PersonalInfo::updateOrCreate(
            [
                'user_id' =>  auth()->user()->id,
            ],
            [
                'user_id' => auth()->user()->id,
                'name' => $request->get('first_name') . ' ' . $request->get('last_name'),
                'avatar' => $imageString,
                'gender' => $request->get("gender"),
                'designation' => $request->get('designation'),
                'maritual_status' => $request->get('maritual_status'),
                'dob' => $request->get('date_of_birth'),
                'phone' => $request->get('phone'),
                'nationality' => $request->get('nationality'),
                'email' => $request->get('email')
            ],
        );

        // if user is company then do update company also
        $role = auth()->user()->roles->pluck('slug')->first();

        if ($role && $role == 'company') {
            $user_id = auth()->user()->id;
        
            $company = Company::updateOrCreate(
                [
                    'user_id' => $user_id
                ],
                [
                    'name' => $personalInfo->name,
                    'email' => $personalInfo->email,
                    'phone' => $personalInfo->phone
                ]
            ); 
        }
        

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

    public function saveImage($request)
    {
        $imageString = '';

        if ($request->has('avatar')) {
            $image = $request->avatar;
            $filePath = $this->fileUpload($image, "avatar");
            $imageUrl = asset("public/storage/avatar/{$filePath}");
            $imageString = $imageUrl;
        }

        return $imageString;
    }

    public function deleteImage($imageString)
    {
        $fileUrl = Config::get('app.file_url');

        $image = $imageString;

        $image = str_replace($fileUrl, "", $image);
        Storage::disk('public')->delete($image);
    }

}
