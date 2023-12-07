<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CompanyAddRequest;
use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $companies = Company::with('user')->paginate(16); 
 
        return view('company/index',compact('companies'));
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
    public function store(CompanyAddRequest $request)
    {
        $verificationCode = str_pad(mt_rand(0, 99999), 5, '0', STR_PAD_LEFT);
        $password = str_pad(mt_rand(0, 99999999), 8, '0', STR_PAD_LEFT);
        $user = User::create([
            'name' => $request->input('company_name'),
            'email' => $request->input('email'),
            'password' => Hash::make($password),
            'role' => 'company', // Set the user role as 'company'
            'verification_code' => $verificationCode,
            'email_verified_at' => null,
        ]);
        $user_id = $user->id;
        $message = 'Company addition fails!';
        $status = 'error';
        if($user_id){
            $message = 'Successfully added a new company.';
            $status = 'success';
            $company = Company::create([
                'name' => $request->input('company_name'),
                'email' => $request->input('email'),
                'tagline' => $request->input('tagline'),
                'phone' => $request->input('phone'),
                'location' => $request->input('location'),
                'user_id' => $user_id
            ]);
        }
        return redirect()->route('company.index')->with($status, $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company){  
        return view('company/show',compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    { 
         return view('company/edit',compact('company'));
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

        $company = Company::find($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'description' => 'required',
            'tagline' => 'required',
            'phone' => 'required',
            'location' => 'required',
            'country' => 'required',
        ]);
        
        if ($company) {
            $company->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'about' => $request->input('description'),
                'tagline' => $request->input('tagline'),
                'phone' => $request->input('phone'),
                'location' => $request->input('location'),
                'country' => $request->input('country'),
            ]);
        }
        

        return redirect()->route('company.index')->with('success', 'Company Updated Successfuly!');
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
}
