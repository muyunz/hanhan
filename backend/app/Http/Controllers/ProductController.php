<?php


namespace App\Http\Controllers;


use App\Http\Requests\PatchProductOptionRequest;
use App\Http\Requests\StoreProductOptionRequest;
use App\Http\Requests\PaginationRequest;
use App\Http\Requests\PatchProductRequest;
use App\Http\Requests\StoreProductRequest;
use App\Presenters\ProductOptionPresenter;
use App\Presenters\ProductPresenter;
use App\Services\AttachmentService;
use App\Services\FileService;
use App\Services\ProductService;
use App\Services\UploadService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * @var ProductService
     */
    private $productService;

    /**
     * @var UploadService
     */
    private $uploadService;

    /**
     * @var FileService
     */
    private $fileService;

    /**
     * @var AttachmentService
     */
    private $attachmentService;


    public function __construct(AttachmentService $attachmentService, FileService $fileService, ProductService $productService, UploadService $uploadService)
    {
        $this->productService = $productService;
        $this->uploadService = $uploadService;
        $this->fileService = $fileService;
        $this->attachmentService = $attachmentService;
    }

    /**
     * 取得產品列表
     * @param ProductPresenter $presenter
     * @param PaginationRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function paginated(ProductPresenter $presenter, PaginationRequest $request)
    {
        return $this->respondPaginated(
            $presenter->pagination(
                $this->productService->paginate(
                    $request->page(),
                    $request->perPage(),
                    ["*"],
                    ["attachments"]
                )
            )
        );
    }

    /**
     * 根據 id 取得產品
     * @param ProductPresenter $presenter
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function item(ProductPresenter $presenter, $id)
    {
        return $this->respondItem(
            $presenter->item($this->productService->getOneOrFailById($id))
        );
    }

    /**
     * 建立產品
     * @param StoreProductRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreProductRequest $request)
    {
        $file = $this->uploadService->saveFile($request->previewFile());
        $product = $this->productService->create($request->product());
        $product->attachFile($file, 'preview');

        return $this->respondCreateItem($product);
    }

    /**
     * 刪除產品
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        $this->productService->delete($id);
        return $this->respondNoContent();
    }

    /**
     * 更新產品
     * @param PatchProductRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function patch(PatchProductRequest $request)
    {
        $id = $request->id();

        // 如果有已存在的檔案且有欲更新的檔案
        if ($request->previewFile()) {
            $file = $this->uploadService->saveFile($request->previewFile());
            $this->productService->deletePreview($id);
            $this->productService->setPreview($id, $file);
        }

        $product = $this->productService->update($id, $request->patchProduct());

        return $this->respondItem($product);
    }

    public function options(ProductOptionPresenter $presenter, $id)
    {
        $options = $this->productService->getProductOptions($id);
        return $this->respondCollection(
            $presenter->collection($options)
        );
    }

    /**
     * 加入產品選項
     * @param $id
     * @param StoreProductOptionRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addOption($id, StoreProductOptionRequest $request)
    {
        $option = $request->productOption();
        $option = $this->productService->addProductOption($id, $option["name"], $option["price"]);
        return $this->respondItem($option);
    }

    /**
     * 刪除產品選項
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteOption(Request $request, $id)
    {
        $optionId = $request->query("option_id");
        $this->productService->deleteProductOption($id, $optionId);
        return $this->respondNoContent();
    }

    /**
     * 更新產品選項
     * @param PatchProductOptionRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function patchOption(PatchProductOptionRequest $request)
    {
        return $this->respondItem(
            $this->productService->patchProductOption($request->optionId(), $request->patchProductOption())
        );
    }

    /**
     * 取得全部產品(全部關聯)
     * @return \Illuminate\Http\JsonResponse
     */
    public function all(ProductPresenter $presenter) {
        return $this->respondCollection(
            $presenter->collection($this->productService->fetchFullProducts())
        );
    }
}
