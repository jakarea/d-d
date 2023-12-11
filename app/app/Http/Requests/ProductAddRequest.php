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
                    'array',
                ],
                'product_varients.*.title'=>[
                    'required',
                    'string',
                    'min:2',
                    'max:255'
                ],
                'product_varients.*.cats'=>[
                    'required',
                    'array'
                ],
                'product_varients.*.product_url'=>[
                    'nullable',
                    'url'
                ],
                'product_varients.*.price'=>[
                    'required',
                    'numeric',
                    'between:0,9999999.99'
                ],
                'product_varients.*.sell_price'=>[
                    'nullable',
                    'numeric',
                    'between:0,9999999.99',
                    'lt:price'
                ],
                'product_varients.*.cupon' => [
                    'nullable',
                    'string',
                    'min:2',
                    'max:20'
                ],
                'product_varients.*.description' => [
                    'nullable',
                    'string',
                ],
                'product_varients.*.images' => [
                    'nullable',
                    'array',
                ]
            ];


    }
}
