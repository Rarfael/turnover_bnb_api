<?php


namespace App\Domain\Product;


use Carbon\Carbon;

interface ProductRepository
{

    /** @return Product[] */
    public function all(): array;
    public function findById(int $id): Product;
    public function create(Product $product): Product;
    public function update(int $productId, Product $product): void;
    public function deleteById(int $id): void;
    public function getBetween(Carbon $start, Carbon $end): array;

    /**
     * @param Product[]
     */
    public function createMany(array $product): void;

    /**
     * @param Product[]
     */
    public function updateMany(array $product): void;
}
