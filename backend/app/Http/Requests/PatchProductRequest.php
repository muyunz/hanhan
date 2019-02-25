<?php

namespace App\Http\Requests;

class PatchProductRequest extends StoreProductRequest
{
    protected $patchFields = ['name', 'price', 'description'];

    public function rules()
    {
        return [
            'name' => 'sometimes|required|string',
            'price' => 'sometimes|required|integer',
        ];
    }

    public function patchProduct()
    {
        return array_filter($this->only($this->patchFields), function ($value) {
            return $value != null;
        });
    }

    public function id()
    {
        return (int)$this->route('id');
    }
}
