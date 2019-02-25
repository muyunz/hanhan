<?php


namespace App\Services;


use App\Enums\AttachmentType;
use App\Models\File;
use App\Models\Product;
use App\Repositories\ProductOptionRepository;
use App\Repositories\ProductRepository;

class ProductService extends Service
{

    protected $productRepository;
    protected $attachmentService;
    private $productOptionRepository;

    public function __construct(ProductOptionRepository $productOptionRepository, ProductRepository $productRepository, AttachmentService $attachmentService)
    {
        $this->productRepository = $productRepository;
        $this->attachmentService = $attachmentService;
        $this->productOptionRepository = $productOptionRepository;
    }

    public function create(array $attributes)
    {
        return $this->productRepository->create($attributes);
    }

    public function update($id, array $attributes)
    {
        return $this->productRepository->update($attributes, $id);
    }

    public function delete($id)
    {
        return $this->productRepository->delete($id);
    }

    public function getOneById($id)
    {
        return $this->productRepository->find($id);
    }

    public function getOneOrFailById($id)
    {
        return $this->productRepository->findOrfail($id);
    }

    public function paginate(int $page, int $perPage, $columns = ["*"], $with = [])
    {
        return $this->productRepository
            ->paginate($page, $perPage, $columns, $with);
    }

    public function deletePreview($id)
    {
        $product = $this->getOneById($id);
        $attachment = $this->attachmentService->getOneByModelAndType(Product::class, $product->id, AttachmentType::PREVIEW);

        if (is_null($attachment)) {
            return false;
        }

        $this->attachmentService->delete($attachment->id, true);
    }

    public function setPreview($id, $file)
    {
        if ($file instanceof File) {
            $file = $file->id;
        }

        $product = $this->getOneById($id);
        $attachment = $this->attachmentService->attachFile(Product::class, $product->id, $file, AttachmentType::PREVIEW);
        return $attachment;
    }

    public function getProductOptions($productId) {
        return $this->productOptionRepository->getByProduct($productId);
    }

    /**
     * 新增產品選項
     * @param $productId
     * @param $name
     * @param $price
     * @return mixed
     */
    public function addProductOption($productId, $name, $price)
    {
        $product = $this->getOneOrFailById($productId);
        return $product->options()->create([
            "name" => $name,
            "price" => $price
        ]);
    }

    /**
     * 刪除產品選項
     * @param $productId
     * @param $optionId
     * @return mixed
     */
    public function deleteProductOption($productId, $optionId)
    {
        $product = $this->getOneOrFailById($productId);
        return $product->options()->where("id", $optionId)->delete();
    }

    /**
     * 更新產品選項
     * @param $optionId
     * @param $option
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function patchProductOption($optionId, $option)
    {
        return $this->productOptionRepository->update($option, $optionId);
    }

    /**
     * 取得全部產品(完整關聯)
     * @return ProductRepository[]|\Illuminate\Database\Eloquent\Collection
     */
    public function fetchFullProducts()
    {
        return $this->productRepository->getFull();
    }
}
