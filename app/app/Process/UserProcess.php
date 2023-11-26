<?php

namespace App\Process;
use App\Models\User;
use Illuminate\Http\Request;

class UserProcess{

    public static function update(Request $request, $user)
    {
        $user = (new self())->saveUser($request, $user);

        return $user;
    }

    public function saveUser($request, $user)
    {
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return $user;
    }
}
