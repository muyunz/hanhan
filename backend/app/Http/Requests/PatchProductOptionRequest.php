<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatchProductOptionRequest extends FormRequest
{

    protected $patchFields = ['name', 'price'];

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "name" => "sometimes|string|required",
            "price" => "sometimes|integer|required"
        ];
    }

    public function patchProductOption()
    {
        return array_filter($this->only($this->patchFields), function ($value) {
            return $value != null;
        });
    }

    public function productId()
    {
        return (int)$this->route("id");
    }

    public function optionId()
    {
        return (int)$this->query("option_id");
    }
}
