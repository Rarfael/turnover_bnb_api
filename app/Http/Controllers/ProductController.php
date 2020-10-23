<?php

namespace App\Http\Controllers;

use App\Domain\Product\Product;
use App\Domain\Product\ProductRepository;
use App\Repositories\Product\ProductEloquentRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    private ProductEloquentRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return array_map(fn($product) => $product->toArray(), $this->productRepository->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $products = $request->all();
        if (!is_array(reset($products))) {
            return $this->productRepository->create(Product::make($request->all()))->toArray();
        }
        $this->productRepository->createMany($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        return $this->productRepository->findById($id)->toArray();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->productRepository->update($id, Product::make($request->all()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->productRepository->deleteById($id);
    }
}
