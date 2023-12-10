<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CustomerAddRequest;
use App\Models\Company;
use App\Models\Customer;
use App\Models\User;
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
        // $this->sendVerificationEmail($user, $verificationCode);

        // return $user;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    { 
        // return $user->reviews; 
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
        //
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

    public function editAddress(User $user){
        return view('customer/editAddress', compact('user'));
    }
}
