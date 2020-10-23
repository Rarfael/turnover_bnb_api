<?php


namespace App\Domain\Product;


use App\Domain\Money;

class Product
{
    private ?int $id;
    private string $name;
    private string $description;
    private Money $price;

    public function __construct(?int $id, string $name, string $description, Money $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
    }

    public static function make(array $product): Product
    {
        return new Product(
            $product['id'] ?? null,
            $product['name'],
            $product['description'],
            new Money($product['currency'], $product['price'])
        );
    }

    public function id(): int
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
            'currency' => $this->price->currency()
        ];
    }
}
