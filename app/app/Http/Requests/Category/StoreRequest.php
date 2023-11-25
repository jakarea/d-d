<?php

namespace App\Http\Requests\Category;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=>[
                'required',
                'string',
                'min:2',
                'max:255'
            ],
            'icon'=>[
                'required',
                'image',
                'mimes:jpeg,jpg,png,gif'.
                'max:1024'
            ],
        ];
    }

    public function messages()
    {
        return [
            'icon.required' => "Upload an icon about this category-related.",
            'icon.max'      => "Maximum file size to upload is 1MB (1024 KB). If you are uploading a photo, try to reduce its resolution to make it under 1MB"
        ];
    }
}
