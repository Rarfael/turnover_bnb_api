<?php


namespace App\Domain\Product;


interface ProductRepository
{

    /** @return Product[] */
    public function all(): array;
    public function findById(int $id): Product;
    public function create(Product $product): Product;
    public function update(int $productId, Product $product): void;
    public function deleteById(int $id): void;
    public function getBetween(\DateTime $start, \DateTime $end): array;

    /**
     * @param Product[]
     */
    public function createMany(array $product): void;

    /**
     * @param Product[]
     * @return Product[]
     */
    public function updateMany(array $product): array;
}
