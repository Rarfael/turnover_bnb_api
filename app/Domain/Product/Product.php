<?php


namespace App\Domain\Product;


use App\Domain\Money;

class Product
{
    private ?int $id;
    private string $name;
    private string $description;
    private Money $price;
    private ?string $created_at;
    private ?string $updated_at;

    public function __construct(?int $id, string $name, string $description, Money $price, ?string $created_at, ?string $updated_at)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    public static function make(array $product): Product
    {
        return new Product(
            $product['id'] ?? null,
            $product['name'],
            $product['description'],
            new Money($product['currency'], $product['price']),
            $product['created_at'] ?? null,
            $product['updated_at'] ?? null
        );
    }

    public function id(): ?int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function createdAt(): ?string
    {
        return $this->created_at;
    }

    public function updatedAt(): ?string
    {
        return $this->updated_at;
    }

    public function setName(string $name): Product
    {
        $this->name = $name;
        return $this;
    }

    public function setDescription(string $description): Product
    {
        $this->description = $description;
        return $this;
    }

    public function setPrice(Money $price): Product
    {
        $this->price = $price;
        return $this;
    }

    public function price(): Money
    {
        return $this->price;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price->price(),
            'currency' => $this->price->currency(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
