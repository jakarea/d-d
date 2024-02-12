<?php

/**
 * BaseFormRequest class for handling common behavior in form requests.
 *
 * This class extends Laravel's FormRequest and provides a global customization
 * for handling failed validation. When validation fails, it throws an
 * HttpResponseException with a JSON response containing validation errors.
 *
 * @category   HTTP
 * @package    Requests
 * @subpackage BaseFormRequest
 * @author     Your Name
 * @license    https://opensource.org/licenses/MIT MIT License
 * @link       Your Documentation Link
 */

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class BaseFormRequest extends FormRequest
{

    /**
     * Handle a failed validation attempt.
     *
     * When validation fails, it throws an HttpResponseException with a JSON response
     * containing validation errors.
     *
     * @param \Illuminate\Contracts\Validation\Validator $validator The validator instance.
     *
     * @return void
     *
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */


     protected function failedValidation(Validator $validator)
     {
         $errors = $validator->errors();
         $firstErrorMessage = $errors->all()[0]; // Get the first error message

         throw new HttpResponseException(
             response()->json([
                 'success' => false,
                 'message' => $firstErrorMessage, // Use the first error message here
                 'data' => [],
                 'errors' => $errors->messages(), // Optionally, you can still pass all the errors
             ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
         );
     }


    protected function jsonResponse($errorCode, $message, $data, $errors, $status = 200)
    {
        return response()->json([
            'error' => $errorCode,
            'message' => $message,
            'data' => $data,
            'errors' => $errors,
        ], $status);
    }
}
