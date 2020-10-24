<?php

namespace Tests\Feature\Controllers;

use App\Domain\Money;
use App\Domain\Product\Product;
use App\Product as ProductModel;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    /**
     * @test
     * @return void
     */
    public function it_should_return_a_list_of_products_stored_in_database()
    {
        $products = ProductModel::all()
            ->map(fn($product) => Product::make($product->toArray())->toArray())
            ->toArray();

        $this->get('api/products')
            ->assertStatus(200)
            ->assertJson($products);
    }

    /**
     * @test
     * @return void
     */
    public function it_should_create_a_new_product_in_database()
    {
        $product = factory(ProductModel::class)->make()->toArray();
        $this->post('api/products', $product)
            ->assertStatus(200);
        $this->assertDatabaseHas('products', $product);
    }

    /**
     * @test
     * @return void
     */
    public function it_should_return_a_single_product_saved_in_database()
    {
        $productModel = factory(ProductModel::class)->create();
        $product = Product::make($productModel->toArray());

        $this->get("api/products/$productModel->id")
            ->assertStatus(200)
            ->assertExactJson($product->toArray());
    }

    /**
     * @test
     * @return void
     */
    public function it_should_update_a_product_saved_in_database()
    {
        $productModel = ProductModel::first();
        $product = Product::make($productModel->toArray())
            ->setName('updated name')
            ->setPrice(new Money('USD', 42))
            ->toArray();

        $this->put("api/products/{$product['id']}", $product)
            ->assertStatus(200);
        $this->assertDatabaseHas('products', $product);
    }

    /**
     * @test
     * @return void
     */
    public function it_should_delete_a_product_saved_in_database()
    {
        $product = ProductModel::first();

        $this->delete("api/products/{$product->id}")
            ->assertStatus(200);
        $this->assertDatabaseMissing('products', $product->toArray());
    }

    /**
     * @test
     * @return void
     */
    public function it_should_create_a_many_products_in_database()
    {
        $products = factory(ProductModel::class, 4)->make()->toArray();
        $this->post('api/products', $products)
            ->assertStatus(200);

        foreach ($products as $product) {
            $this->assertDatabaseHas('products', $product);
        }
    }

    /**
     * @test
     * @return void
     */
    public function it_should_update_a_many_products_in_database()
    {
        $products = ProductModel::all()->map(function ($product) {
            return Product::make($product->toArray())
                ->setPrice(new Money('BRL', 1200))
                ->toArray();
        })->toArray();
        $this->put('api/mass-update/products', $products)
            ->assertStatus(200);

        foreach ($products as $product) {
            $this->assertDatabaseHas('products', $product);
        }
    }
}
