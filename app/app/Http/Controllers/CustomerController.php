<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CustomerAddRequest;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Address;
use App\Models\User;
use App\Models\PersonalInfo;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationMail;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('roles')
        ->whereHas('roles', function ($query) {
            $query->where('slug', 'client');
        })
        ->orderBy('id', 'desc')
        ->paginate(16);
 
        return view('customer/index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerAddRequest $request)
    {
        $verificationCode = str_pad(mt_rand(0, 99999), 5, '0', STR_PAD_LEFT);
        $password = str_pad(mt_rand(0, 99999999), 8, '0', STR_PAD_LEFT);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($password),
            'kvk_number' => $request->input('kvk_number'),
            'verification_code' => null,
            'email_verified_at' => now(),
        ]);

        $role = Role::where('slug', 'client')->first();
        $user->roles()->attach($role);

        //  Send verification email
        $this->sendVerificationEmail($user, $verificationCode);

        return redirect()->route('users.index')->with('success', 'User Created Successfuly!');
 
    }

    protected function sendVerificationEmail(User $user, $verificationCode)
    {
        // Use your email template and customize as needed
        Mail::to($user->email)->send(new VerificationMail($user,$verificationCode));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {  
        return view('customer/show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('customer/edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id); 

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
            $image->save(public_path('uploads/users/' . $uniqueFileName));  // Save with the full path
        
            // Generate the full URL using the url helper
            $image_path = url('public/uploads/users/' . $uniqueFileName);
        
            $userInfos->avatar = $image_path;
            $userInfos->save(); // Save the user model to update the avatar path in the database
        }        

        return redirect()->route('users.index')->with('success', 'User Information Updated Successfuly!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function editAddress(User $user,$id){
        $user = User::find($id);
        return view('customer/editAddress', compact('user'));
    }
    
    public function updateAddress(Request $request,$id){
        //  return $request->all();

        $request->validate([
            'primary_address' => 'required',
            'country' => 'required', 
            'city' => 'required',
            'state' => 'required',
            'post_code' => 'required'
        ]);

        $user = User::find($id); 

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

        return redirect()->route('users.index')->with('success', 'User Address Information Updated Successfuly!');

    }
}
