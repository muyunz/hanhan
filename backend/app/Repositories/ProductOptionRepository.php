<?php


namespace App\Repositories;


use App\Models\ProductOption;

class ProductOptionRepository extends Repository
{
    public function __construct(ProductOption $model)
    {
        parent::__construct($model);
    }

    public function getByProduct($id) {
        return $this->model->where('product_id', $id)->get();
    }

}
