<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaginationRequest extends FormRequest
{

    protected $pageParameter = "page";
    protected $perPageParameter = "per_page";

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
        ];
    }

    public function pagination()
    {
        return [
            "page" => $this->get($this->pageParameter),
            "perPage" => $this->get($this->perPageParameter)
        ];
    }

    public function page()
    {
        return $this->get($this->pageParameter);
    }

    public function perPage()
    {
        return $this->get($this->perPageParameter);
    }
}
