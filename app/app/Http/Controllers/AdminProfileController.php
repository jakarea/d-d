<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Address;
use App\Models\User;
use App\Models\PersonalInfo;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str; 
use App\Models\Role;
use Auth;

class AdminProfileController extends Controller
{
    public function index()
    {
        $profile = User::find(Auth::id()); 
        return view('admin-profile/details',compact('profile'));
    }
    

    public function edit()
    {
        $user = User::find(Auth::id()); 
        return view('admin-profile/edit',compact('user'));
    }

    public function update(Request $request)
    {
        // return $request->all();

        $user = Auth::user(); 

        $request->validate([
            'name' => 'required',
            'email' => 'required', 
            'designation' => 'required',
            'phone' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            'nationality' => 'required',
            'maritual_status' => 'required',
        ]);
 

        if ($user) {
            $user->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'), 
            ]);
        } 
 
        $userInfos = PersonalInfo::updateOrCreate(
            ['user_id' => $user->id],
            [
                'name' => $request->input('name'),
                'user_id' => $user->id,
                'email' => $request->input('email'),
                'designation' => $request->input('designation'),
                'phone' => $request->input('phone'),
                'dob' => $request->input('dob'),
                'gender' => $request->input('gender'),
                'nationality' => $request->input('nationality'),
                'maritual_status' => $request->input('maritual_status'), 
            ]
        );

        $slugg = Str::slug($request->name);

        if ($request->hasFile('avatar')) {
            if ($userInfos->avatar) {
                $oldFile = public_path($userInfos->avatar);
                if (file_exists($oldFile)) {
                    unlink($oldFile);
                }
            }
        
            $file = $request->file('avatar');
            $image = Image::make($file);
            $uniqueFileName = $slugg . '-' . uniqid() . '.webp';
            $image->save(public_path('uploads/users/' . $uniqueFileName));
            $image_path = url('public/uploads/users/' . $uniqueFileName);
            $userInfos->avatar = $image_path;
            $userInfos->save();
        }        

        return redirect()->route('admin.profile')->with('success', 'Admin Profile Updated Successfuly!');
    }

    public function editAddress()
    {
        $user = User::find(Auth::id()); 
        return view('admin-profile/edit-address',compact('user'));
    }

    public function updateAddress(Request $request)
    {
        // return $request->all(); 

        $request->validate([
            'primary_address' => 'required',
            'country' => 'required', 
            'city' => 'required',
            'state' => 'required',
            'post_code' => 'required'
        ]);

        $user = Auth::user(); 

        if ($user) {
            Address::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'primary_address' => $request->input('primary_address'),
                    'user_id' => $user->id,
                    'country' => $request->input('country'),
                    'city' => $request->input('city'),
                    'state' => $request->input('state'),
                    'post_code' => $request->input('post_code')
                ]
            );
        } 

        return redirect()->route('admin.profile')->with('success', 'Admin Address Updated Successfuly!');
    }
}
