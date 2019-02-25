<?php


namespace App\Services;


use App\Repositories\ProductRepository;

class ProductService extends Service
{

    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function create(array $attributes) {
        $this->productRepository->create($attributes);
    }
}
