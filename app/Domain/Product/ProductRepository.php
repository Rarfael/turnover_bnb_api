<?php


namespace App\Domain\Product;


interface ProductRepository
{

    /** @return Product[] */
    public function all(): array;
    public function findById(int $id): Product;
    public function create(Product $product): Product;
    public function update($productId): array;
    public function deleteById(int $id): void;

    /**
     * @param Product[]
     * @return Product[]
     */
    public function getBetween(\DateTime $start, \DateTime $end): array;

    /**
     * @param Product[]
     * @return Product[]
     */
    public function createMany(array $product): array;

    /**
     * @param Product[]
     * @return Product[]
     */
    public function updateMany(array $product): array;
}
