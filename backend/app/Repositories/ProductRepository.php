<?php


namespace App\Repositories;


use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductRepository extends Repository
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    public function paginate(int $page, int $perPage, $columns = ["*"], $with = [], $pageName = "page")
    {
        /** @var LengthAwarePaginator $res */
        return $this->model
            ->with($with)
            ->paginate($perPage, $columns, $pageName, $page);
    }

    public function getFull()
    {
        return $this->model
            ->with(['options'])
            ->get();
    }
}
