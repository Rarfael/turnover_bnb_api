<?php


namespace App\Repositories\Product;


use App\Domain\Product\Product;
use App\Domain\Product\ProductRepository;
use App\Product as ProductModel;

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

    public function update($productId): array
    {
        // TODO: Implement update() method.
    }

    public function deleteById(int $id): void
    {
        // TODO: Implement deleteById() method.
    }

    public function getBetween(\DateTime $start, \DateTime $end): array
    {
        // TODO: Implement getBetween() method.
    }

    public function createMany(array $product): array
    {
        // TODO: Implement createMany() method.
    }

    public function updateMany(array $product): array
    {
        // TODO: Implement updateMany() method.
    }
}
