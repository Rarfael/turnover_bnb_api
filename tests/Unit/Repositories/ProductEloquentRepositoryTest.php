<?php

namespace Tests\Unit\Repositories;

use App\Domain\Product\Product;
use App\Repositories\Product\ProductEloquentRepository;
use Mockery;
use Tests\TestCase;

class ProductEloquentRepositoryTest extends TestCase
{
    public function tearDown(): void
    {
        parent::tearDown();
        Mockery::close();
    }

    /**
     * @test
     * @return void
     */
    public function it_should_return_an_array_of_products()
    {
        $modelProducts = factory(\App\Product::class, 50)->make();
        $this->mock(\App\Product::class,
            fn($mock) => $mock->shouldReceive('all')->once()->andReturn($modelProducts)
        );
        $productRepository = app(ProductEloquentRepository::class);
        $products = $productRepository->all();

        $this->assertIsArray($products);
        foreach ($products as $key => $product) {
            $this->compareProductProperties($modelProducts[$key], $product);
        }
    }

    /**
     * @test
     * @return void
     */
    public function it_should_find_a_product_by_id()
    {
        $productModel = factory(\App\Product::class, 4)->make()->map(function($product, $index) {
            $product->id = $index + 1;
            return $product;
        });
        $productToFind = $productModel->first();
        $this->mock(\App\Product::class,
            fn($mock) => $mock->shouldReceive('find')->once()->with($productToFind->id)->andReturn($productToFind)
        );

        $productRepository = app(ProductEloquentRepository::class);
        $product = $productRepository->findById($productToFind->id);

        $this->assertTrue($product instanceof Product);
        $this->compareProductProperties($productToFind, $product);
    }

    /**
     * @test
     * @return void
     */
    public function it_should_create_a_new_product()
    {
        $basicProductInfo = ['name' => 'test', 'description' => 'random desc', 'currency' => 'BRL', 'price' => 100];
        $productEntity = Product::make($basicProductInfo);
        $productModel = factory(\App\Product::class)->make(array_merge($basicProductInfo, ['id' => 1]));
        $this->mock(\App\Product::class,
            fn($mock) => $mock->shouldReceive('create')->once()->with($productEntity->toArray())->andReturn($productModel)
        );

        $productRepository = app(ProductEloquentRepository::class);
        $createdProduct = $productRepository->create($productEntity);

        $this->assertEquals($createdProduct->id(), $productModel->id);
    }

    private function compareProductProperties(\App\Product $model, Product $product)
    {
        foreach ($model->toArray() as $key => $item) {
            if ($key === 'price' || $key == 'currency') {
                $this->assertEquals($item, $product->price()->{$key}());
                return;
            }
            $this->assertEquals($item, $product->{$key}());
        }
    }
}
