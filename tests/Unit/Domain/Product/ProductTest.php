<?php

namespace Tests\Unit\Domain\Product;

use App\Domain\Money;
use App\Domain\Product\Product;
use Carbon\Carbon;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    /**
     * @test
     * @return void
     */
    public function it_should_return_a_new_product_object()
    {
        $now = Carbon::now();
        $product = Product::make([
            'name' => 'test',
            'description' => 'text',
            'price' => 1000,
            'currency' => 'BRL',
        ]);

        $this->assertTrue($product instanceof Product);
        $this->assertTrue($product->price() instanceof Money);
    }
}
