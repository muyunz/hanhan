<?php


namespace App\Repositories;


use App\Models\Product;

class ProductRepository extends Repository
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

}
