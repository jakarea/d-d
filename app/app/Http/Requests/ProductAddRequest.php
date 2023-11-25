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


        if (\Request::route()->getName() == "product.store")

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
//                'product_varients'=>[
//                    'required'
//                ]
            ];

        if (\Request::route()->getName() == "product-varient.store")

            return [

                'company_id' => [
                    'required',
                    'integer',
                    'exists:companies,id',
                ],
                'product_id' => [
                    'required',
                    'integer',
                    'exists:products,id',
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
