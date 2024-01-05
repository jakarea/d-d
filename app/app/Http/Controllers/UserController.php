<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\PricingPackage;
use App\Models\Company;
use App\Models\Earning;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\Exceptions\MissingAbilityException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationMail;
use Illuminate\Support\Str; 

class UserController extends API\ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $creds = $request->validate([
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6',
                'confirm_password' => 'required_with:password|same:password|min:6',
                'name' => 'required|string',
                'role' => 'required|exists:roles,slug',
                "kvk_number" => 'nullable'
            ]);
        } catch (ValidationException $e) {
            return $this->validationErrorResponse($e, 422, 'Validation error', 1001);
        }

        $verificationCode = str_pad(mt_rand(0, 99999), 5, '0', STR_PAD_LEFT);
        $user = User::create([
            'name' => $creds['name'],
            'email' => $creds['email'],
            'password' => Hash::make($creds['password']),
            'kvk_number' => $creds['kvk_number'] ?? null,
            'verification_code' => $verificationCode,
            'email_verified_at' => null,
            'status' => 0,
        ]);

        $role = Role::where('slug', $creds['role'])->first();
        $user->roles()->attach($role);

        if ($role->slug == 'company') {
            $company = Company::create([
                'name' => $user->name,
                'email' => $user->email,
                'user_id' => $user->id
            ]);

            $company->save();
        }

        // Send verification email
        try {
            $this->sendVerificationEmail($user, $verificationCode);
        } catch (\Exception  $e) {
            $user->roles()->detach();
            $user->delete();
            return response()->json([
                'error' => 500,
                'message' => 'Failed to send verification email ',
                'errors' => $e->getMessage(),
            ], 200);
        }

        // return $user;
        return $this->jsonResponse(false, $this->success, $user, $this->emptyArray, JsonResponse::HTTP_CREATED);
    }

    protected function validationErrorResponse(ValidationException $e, $status, $message, $errorCode): JsonResponse
    {
        return response()->json([
            'error' => $errorCode,
            'message' => $message,
            'errors' => $e->validator->errors(),
        ], $status);
    }

    protected function sendVerificationEmail(User $user, $verificationCode)
    {
        // Use your email template and customize as needed
        Mail::to($user->email)->send(new VerificationMail($user, $verificationCode));
    }

    /**
     * Authenticate an user and dispatch token.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {

        try {
            $creds = $request->validate([
                'email' => 'required|email',
                'password' => 'required|min:6',
                'role' => 'required|exists:roles,slug',
            ]);
        } catch (ValidationException $e) {
            return $this->validationErrorResponse($e, 422, 'Validation error', 1001);
        }

        $user = User::where('email', $creds['email'])->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response(['error' => true, 'message' => 'invalid credentials'], 401);
        }

        // Check if the user has the required role
        $role = $creds['role'];
        if (!$user->roles()->where('slug', $role)->exists()) {
            return $this->jsonResponse(true, 'Failed to Login', $user, ['User does not have the required role'], 401); 
        }      

        if (config('hydra.delete_previous_access_tokens_on_login', false)) {
            $user->tokens()->delete();
        }

        $roles = $user->roles->pluck('slug')->all();
        $plainTextToken = $user->createToken('hydra-api-token', $roles)->plainTextToken;

        $company = Company::where('user_id', $user->id)->first();
        $earning = Earning::where('user_id', $user->id)->where('status', 'paid')->first();

        $package = NULL;
        if ($earning) {
            $package = PricingPackage::with('myPurchaseInfo')->first();
        }

        $userInfo = [
            'token' => $plainTextToken,
            'user_info' => $user,
            'user_company' => $company,
            'current_package' => $package

        ];

        return $this->jsonResponse(false, 'Successfuly Loggedin!', $userInfo, $this->emptyArray, JsonResponse::HTTP_CREATED);
    }

    /**
     * User Login with google API.
     *
     * @param  \App\Models\User  $user
     * @return \App\Models\User  $user
     */
    public function loginWithGoogle(Request $request,$social_platform)
    {
        try {
            $creds = $request->validate([
                'email' => 'required|email',
                // 'social_platform' => 'required|in:google,facebook,apple',
                'avatar' => 'nullable|mimes:png,svg,webp,jpg,jpeg|max:5048',
            ]);
        } catch (ValidationException $e) {
            return $this->validationErrorResponse($e, 422, 'Validation error', 1001);
        }

        try {
            $user = User::where('email', $creds['email'])->first();

            if ($social_platform === 'google') {

                if ($user) {
                    // email found now do login response for that user
                    if (config('hydra.delete_previous_access_tokens_on_login', false)) {
                        $user->tokens()->delete();
                    }

                    $roles = $user->roles->pluck('slug')->all();
                    $plainTextToken = $user->createToken('hydra-api-token', $roles)->plainTextToken;

                    $company = Company::where('user_id', $user->id)->first();
                    $earning = Earning::where('user_id', $user->id)->where('status', 'paid')->first();

                    $package = NULL;
                    if ($earning) {
                        $package = PricingPackage::with('myPurchaseInfo')->first();
                    }

                    $userInfo = [
                        'token' => $plainTextToken,
                        'user_info' => $user,
                        'user_company' => $company,
                        'current_package' => $package

                    ];

                    return $this->jsonResponse(false, 'Successfuly Loggedin!', $userInfo, $this->emptyArray, JsonResponse::HTTP_CREATED);
                } else {
                    // if email not found then do register
                    $emailParts = explode('@', $creds['email']);
                    $username = (count($emailParts) === 2) ? $emailParts[0] : "No Name"; 

                    $user = User::create([
                        'name' => $username,
                        'email' => $creds['email'],
                        'password' => Hash::make('1234567890'),
                        'kvk_number' => null,
                        'verification_code' => null,
                        'email_verified_at' => now(),
                        'status' => 1,
                    ]);

                    $role = Role::where('slug', 'client')->first();
                    $user->roles()->attach($role);

                    $roles = $user->roles->pluck('slug')->all();
                    $plainTextToken2 = $user->createToken('hydra-api-token', $roles)->plainTextToken;

                    $userInfoRegis = [
                        'token' => $plainTextToken2,
                        'first_time' => 1,
                        'user_info' => $user
                    ];

                    return $this->jsonResponse(false, 'Success! Please visit the reset page to update your password.', $userInfoRegis, $this->emptyArray, JsonResponse::HTTP_CREATED);
                }
            }
        } catch (\Exception $e) {
            return $this->jsonResponse(true, 'Failed to get in', $request->all(), [$e->getMessage()], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \App\Models\User  $user
     */
    public function show(User $user)
    {
        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return User
     *
     * @throws MissingAbilityException
     */
    public function update(Request $request, User $user)
    {
        $user->name = $request->name ?? $user->name;
        $user->email = $request->email ?? $user->email;
        $user->password = $request->password ? Hash::make($request->password) : $user->password;
        $user->email_verified_at = $request->email_verified_at ?? $user->email_verified_at;

        //check if the logged in user is updating it's own record

        $loggedInUser = $request->user();
        if ($loggedInUser->id == $user->id) {
            $user->update();
        } elseif ($loggedInUser->tokenCan('admin') || $loggedInUser->tokenCan('super-admin')) {
            $user->update();
        } else {
            throw new MissingAbilityException('Not Authorized');
        }
        return $user;
    }

    public function updatePassword(Request $request, User $user)
    {
        try {
            $request->validate([
                'new_password' => [
                    'required',
                    'min:8',
                    'regex:/^(?=.*[a-zA-Z])(?=.*\d)/',
                ],
                'confirm_password' => 'required|same:new_password',
            ], [
                'new_password.regex' => 'Ensure that the password contains at least one letter and one number.',
            ]);


            // Update the user's password
            $user->update([
                'password' => Hash::make($request->input('new_password')),
            ]);

            return $this->jsonResponse(0, 'Password updated successfully.');
        } catch (ValidationException $e) {
            return $this->validationErrorResponse($e, 422, 'Validation error', 1001);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $adminRole = Role::where('slug', 'admin')->first();
        $userRoles = $user->roles;

        if ($userRoles->contains($adminRole)) {
            //the current user is admin, then if there is only one admin - don't delete
            $numberOfAdmins = Role::where('slug', 'admin')->first()->users()->count();
            if (1 == $numberOfAdmins) {
                return response(['error' => 1, 'message' => 'Create another admin before deleting this only admin user'], 409);
            }
        }

        $user->delete();

        return response(['error' => 0, 'message' => 'user deleted']);
    }


    /**
     * Return Auth user
     *
     * @param  Request  $request
     * @return mixed
     */
    public function me(Request $request)
    {
        return $request->user();
    }
}
