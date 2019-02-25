<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductOptionRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "name" => "string|required",
            "price" => "integer|required"
        ];
    }

    public function productOption()
    {
        return [
            "name" => $this->get('name'),
            "price" => $this->get('price')
        ];
    }
}
