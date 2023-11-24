<?php

namespace App\Http\Requests\Product;

use App\Http\Requests\BaseFormRequest;

class UpdateRequest extends BaseFormRequest
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
            'title' => [
                'required',
                'string',
                'min:2',
                'max:255'
            ],
            'cats' => [
                'required',
                'string'
            ],
            'product_url' => [
                'nullable',
                'url'
            ],
            'price' => [
                'required',
                'numeric',
                'between:0,9999999.99',
            ],
            'sell_price' => [
                'nullable',
                'numeric',
                'between:0,9999999.99',
                'lt:price'
            ],
            'cupon' => [
                'nullable',
                'string',
                'min:2',
                'max:20'
            ],
            'description' => [
                'nullable',
                'string',
            ],
            'images' => [
                'nullable',
                'string',
            ],
        ];
    }
}
