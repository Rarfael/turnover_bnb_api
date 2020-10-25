<?php


namespace App\Repositories\Product;


use App\Domain\Product\Product;
use App\Domain\Product\ProductRepository;
use App\Product as ProductModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ProductEloquentRepository implements ProductRepository
{
    private ProductModel $productModel;

    public function __construct(ProductModel $product)
    {
        $this->productModel = $product;
    }

    /** @return Product[] */
    public function all(): array
    {
        return $this->productModel
            ->all()
            ->map(fn($product) => Product::make($product->toArray()))
            ->toArray();
    }

    public function findById(int $id): Product
    {
        return Product::make($this->productModel->find($id)->toArray());
    }

    public function create(Product $product): Product
    {
        $newProduct = $this->productModel->create($product->toArray());
        return Product::make($newProduct->toArray());
    }

    public function update(int $productId, Product $product): void
    {
        $this->productModel->find($productId)->update($product->toArray());
    }

    public function deleteById(int $id): void
    {
        $this->productModel->find($id)->delete();
    }

    public function getBetween(Carbon $start, Carbon $end): array
    {
        return $this->productModel->whereBetween('created_at', [$start, $end])->get()->toArray();
    }


    /**
     * @param Product[]
     */
    public function createMany(array $products): void
    {
        $this->productModel->createMany($products);
    }

    /**
     * @param Product[]
     */
    public function updateMany(array $products): void
    {
        DB::beginTransaction();
        foreach ($products as $product) {
            if (!empty($product['id'])) {
                $this->productModel->where('id', $product['id'])->update($product);
            }
        }
        DB::commit();
    }
}
