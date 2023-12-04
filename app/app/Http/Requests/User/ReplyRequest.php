<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class ReplyRequest extends BaseFormRequest
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
            'review_id'=>[
                'required',
                'integer',
                'exists:reviews,id',
            ],
            'reply'=>[
                'required',
                'string',
                'min:2',
                'max:255'
            ]
        ];
    }
}
