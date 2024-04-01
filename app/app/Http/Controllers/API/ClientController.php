<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\User\SecuritySettingRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\Address;
use App\Models\Company;
use App\Models\Earning;
use App\Models\Like;
use App\Models\PersonalInfo;
use App\Models\PricingPackage;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Review;
use App\Models\User;
use App\Models\UserRole;
use App\Models\WishList;
use App\Process\UserProcess;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ClientController extends ApiController
{
    public function profile():JsonResponse
    {
        $user = User::with(['personalInfo','company','address'])->where('id', auth()->user()->id)->first();
        $package = NULL;
        if ($user->payments) {
            $package = PricingPackage::where('id',$user->payments->pricing_packages_id)->first();
        }

        $userInfo = [
            'user_info' => $user,
            'company' => $user->company ? $user->company : null,
            'current_package_info' => [
                'is_expired' => optional($user->payments)->end_at > now() ? 0 : 1,
                'package' => $package,
                'payment_info' => $user->payments
            ]
        ];


        return $this->jsonResponse(false, $this->success, $userInfo, $this->emptyArray, JsonResponse::HTTP_OK);
    }

    public function profileUpdate(Request $request):JsonResponse
    {
        $requestData = $request->all();
        $currentUrl = $request->fullUrl();
        $data = [
            'url' => $currentUrl,
            'body' => $requestData,
        ];
        
        $content = json_encode($data, JSON_PRETTY_PRINT);
 
        $filePath = 'profile.json'; 
        $message = 'profile-error.json'; 

        // Write the content to the file
        Storage::disk('public')->put($filePath, $content);

        try {

            $creds = $request->validate([
                'first_name' => 'required|min:2|max:100',
                'last_name' => 'required|min:2|max:155',
                'date_of_birth' => 'required|date_format:Y-m-d',
                'email' => [
                    'required',
                    'email',
                    'regex:/(.+)@(.+)\.(.+)/i',
                    'unique:users,email,' . auth()->user()->id,
                    'max:255'
                ],
                'phone' => 'required|numeric',
                'address' => 'required|min:5',
                'postcode' => 'required|numeric|digits:4',
                'country' => 'required',
                'avatar' => 'nullable|string',
            ]);

            $user = User::where('id', auth()->user()->id)->with('company')->first();

            $user = UserProcess::update($request, $user, $creds);

            return $this->jsonResponse(false, 'Profile updated successfully', $user, $this->emptyArray, JsonResponse::HTTP_CREATED);
        } catch (ValidationException $e) {
            $errorMessage = $e->errors(); // This gets an array of validation errors
            $firstError = array_values($errorMessage)[0][0]; // This gets the first error message
            
            // Write the first validation error message to the file
            Storage::disk('public')->put($message, $this->jsonResponse(true, $firstError, $request->all(), [$firstError], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));

            return $this->jsonResponse(true, $firstError, $request->all(), [$firstError], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        } catch (\Exception $e) {
            // This will catch all other exceptions
            $errors = $e->getMessage();

            return $this->jsonResponse(true, 'Failed to update profile', $request->all(), [$errors], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function securitySettings(SecuritySettingRequest $request): JsonResponse
    {
        try {
            // Validate email and phone upfront
            $validatedData = $request->validate([
                'email' => 'required|email|max:255',
                'phone' => 'required|numeric',
                'password' => [
                    'nullable', // Makes the password optional
                    'min:8',
                    'regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/',
                ],
            ], [
                'password.regex' => 'Ensure that the password contains at least one letter and one number.',
            ]);

            // Find the user by email
            $user = User::where('email', $validatedData['email'])->first();

            if (!$user) {
                return $this->jsonResponse(true, 'Email does not match our records', [], ['email' => ['Email not found!']], 404);
            }

            // Update the password if provided
            if (!empty($validatedData['password'])) {
                $user->password = Hash::make($validatedData['password']);
                $user->save(); // Save only if there's a new password to update
            }

            // Update or create personal info with the validated phone and possibly other data
            $personalInfo = PersonalInfo::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'name' =>  $user->name, // Assuming you want to use the name from the User model
                    'phone' => $validatedData['phone'],
                    'email' => $user->email, // This uses the user's email, ensuring it matches the one validated
                ]
            );

            // Prepare the response data
            $userInfo = array_merge($user->toArray(), $personalInfo->toArray());

            return $this->jsonResponse(false, 'Profile updated successfully', $userInfo, [], JsonResponse::HTTP_OK);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Extract and return the first validation error message
            $errors = $e->errors();
            $firstError = reset($errors)[0]; // Get the first error of the first field that failed validation
            return $this->jsonResponse(true, $firstError, [], [$firstError], $e->status);
        } catch (\Exception $e) {
            // Handle other exceptions
            return $this->jsonResponse(true, 'An unexpected error occurred', [], [$e->getMessage()], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function deleteAccount($user_id)
    {
        if (!$user_id) {
            return $this->jsonResponse(true, 'User not found!', $user_id, $this->emptyArray, JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }

        if ($user_id != auth()->user()->id) {
            return $this->jsonResponse(true, 'You do not have permission to delete this user!', $user_id, $this->emptyArray, JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
        
        $user = User::find($user_id); 
        $company = Company::where('user_id', $user->id)->first();

        if ($company) {
            $products = Product::where('user_id',$user->id)->get();
            $productsVarients = ProductVariant::where('user_id',$user->id)->get();
            $earnings = Earning::where('user_id',$user->id)->get();
            

            // delete product varients
            foreach ($productsVarients as $productsVarient) {
                $productsVarient->delete();
            }

            // delete products
            foreach ($products as $product) {
                $product->delete();
            }

            // delete earnings
            foreach ($earnings as $earning) {
                $earning->delete();
            }

            // delete company
            $company->delete();
        }
        
        $userInfo = PersonalInfo::where('user_id', $user->id)->first();
        $userAddress = Address::where('user_id', $user->id)->first();
        $userRole = UserRole::where('user_id', $user->id)->first();
        $likes = Like::where('user_id',$user->id)->get();
        $reviews = Review::where('user_id',$user->id)->get();
        $wishlists = WishList::where('user_id',$user->id)->get();
    
        // remove from wishlist
        if ($wishlists) { 
            foreach ($wishlists as $wishlist) {
                $wishlist->delete();
            }
        }

        // delete reviews
        if ($reviews) { 
            foreach ($reviews as $review) {
                $review->delete();
            }
        }

        // delete likes
        if ($likes) { 
            foreach ($likes as $like) {
                $like->delete();
            }
        }
        
        // delete role
        if ($userRole) {
            $userRole->delete();
        }

        // delete address
        if ($userAddress) {
            $userAddress->delete();
        }

        // delete personal info
        if ($userInfo) {
            $userInfo->delete();
        }
        
        // delete main user
        if ($user) {
            $user->delete();
        }
        
        return $this->jsonResponse(false, 'Profile deleted successfully', $user, $this->emptyArray, JsonResponse::HTTP_CREATED);
    }
}
