<?php


namespace App\Http\Controllers;


use App\Http\Requests\StoreProductRequest;
use App\Services\ProductService;

class ProductController extends Controller
{

    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function store(StoreProductRequest $request)
    {
        $product = $this->productService->create($request->product());
        return response()->json([])
    }

}
