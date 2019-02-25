<?php

namespace App\Http\Controllers;

use App\Transformers\PaginatorTransformer;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * 回傳一個項目
     * @param $item
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondItem($item)
    {
        return $this->respondJson($item);

    }

    /**
     * 回傳新增項目
     * @param $item
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondCreateItem($item)
    {
        return $this->respondJson($item, 201, "created");
    }

    /**
     * 回傳更新項目
     * @param $item
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondUpdateItem($item)
    {
        return $this->respondJson($item, 200, "updated");

    }

    /**
     * 回傳一個集合
     * @param $collection
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondCollection($collection)
    {
        return $this->respondJson($collection);
    }

    /**
     * 回傳無內容
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondNoContent()
    {
        return response()->json(null, 204);
    }

    public function respondPaginated($instance)
    {
        return $this->respondJson($instance);
    }

    /**
     * 回傳 JSON
     * @param null $data
     * @param string $code
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondJson($data = null, $code = 200, $message = "success")
    {
        return response()->json([
            "data" => $data,
            "code" => $code,
            "message" => $message
        ]);
    }
}
