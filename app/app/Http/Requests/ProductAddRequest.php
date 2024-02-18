<?php

namespace App\Http\Requests;

class ProductAddRequest extends BaseFormRequest
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
            'company_id' => [
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
                'array'
            ],
            'product_url' => [
                'required',
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
            'deal_type' => [
                'nullable',
                'string',
            ],
            'deal_expired_at' => [
                'nullable',
                'date_format:Y-m-d H:i:s',
            ],
            'is_deal_expired' => [
                'nullable',
                'boolean',
            ],
            'location' => [
                'required',
                'string',
            ],
            'location_latitude' => [
                'required',
                'numeric',
                'between:-90,90',
            ],
            'location_longitude' => [
                'required',
                'numeric',
                'between:-180,180',
            ],
            'images' => [
                'nullable',
                'array',
            ],
            'product_variants.*.title' => [
                'required',
                'string',
                'min:2',
                'max:255'
            ],
            'product_variants.*.product_url' => [
                'required',
                'url'
            ],
            'product_variants.*.price' => [
                'required',
                'numeric',
                'between:0,9999999.99'
            ],
            'product_variants.*.sell_price' => [
                'nullable',
                'numeric',
                'between:0,9999999.99',
                'lt:price'
            ],
            'product_variants.*.cupon' => [
                'nullable',
                'string',
                'min:2',
                'max:20'
            ],
            'product_variants.*.description' => [
                'nullable',
                'string',
            ],
            'product_variants.*.images' => [
                'nullable',
                'array',
            ]
        ];
    }
}
