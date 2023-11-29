<?php

namespace App\Process;

use App\Models\Address;
use App\Models\PersonalInfo;
use App\Models\User;
use Illuminate\Http\Request;

class UserProcess
{

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
        $personalInfo = PersonalInfo::updateOrCreate(
            [
                'user_id' => auth()->user()->id,
            ],
            [
                'user_id' => auth()->user()->id,
                'name' => $request->get('first_name') . ' ' . $request->get('last_name'),
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

}
