<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddReviewRequest extends BaseFormRequest
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
            'company_id'=>[
                'required',
                'integer',
                'exists:companies,id',
            ],
            'product_id'=>[
                'required',
                'integer',
                'exists:products,id',
            ],
            'review'=>[
                'required',
                'string',
                'min:2',
                'max:255'
            ],
            'rating'=>[
                'required',
                'integer',
                'between:1,5',
            ]
        ];
    }
}
