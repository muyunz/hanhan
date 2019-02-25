<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'name' => 'required|string',
            'price' => 'required|integer',
            'preview' => 'required'
        ];
    }

    public function product() {
        return [
            'name' => $this->get('name'),
            'price' => (int)$this->get('price'),
            'description' => $this->get('description', null)
        ];
    }

    public function previewFile() {
        return $this->file('preview');
    }
}
