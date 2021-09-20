<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            "product_name"          => "required|min:2|unique:products,product_name|max:255",
            "product_description"   => "required",
            "product_quantity"      => "required",
            "product_price"         => "required",
            "product_tax"           => "required",
            "category_id"           => "required",
            "brand_id"              => "required"
        ];
    }
}
