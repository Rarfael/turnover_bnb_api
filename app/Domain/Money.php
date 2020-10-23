<?php


namespace App\Domain;


class Money
{
    const CURRENCIES_SUPPORTED = ['USD', 'BRL'];

    private int $price;
    private string $currency;


    public function __construct(string $currency, int $price)
    {
        $this->setPrice($price);
        $this->setCurrency($currency);
    }

    public function price(): int
    {
        return $this->price;
    }

    public function currency(): string
    {
        return $this->currency;
    }

    private function setPrice(int $price): void
    {
        if (!is_int($price) || $price < 0) {
            throw new \InvalidArgumentException('The price should be a positive integer');
        }

        $this->price = $price;
    }

    private function setCurrency(string $currency)
    {
        if (!in_array($currency, Self::CURRENCIES_SUPPORTED)) {
            throw new \InvalidArgumentException('Currency not supported');
        }
        $this->currency = $currency;
    }

    public function toString(): string
    {
        $price = $this->price / 100;
        if($this->currency === 'BRL') return number_format($price, 2,',', '.');
        if($this->currency === 'USD') return number_format($price, 2);
    }

    public function toDecimal(): float
    {
        return $this->price / 100;
    }

    public function toArray()
    {
        return ['price' => $this->price, 'currency' => $this->currency];
    }
}
