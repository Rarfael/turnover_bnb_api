<?php

namespace App\Http\Controllers;

use App\Domain\Product\Product;
use App\Domain\Product\ProductRepository;
use App\Http\Requests\CreateProduct;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        return array_map(fn($product) => $product->toArray(), $this->productRepository->all());
    }

    /**
     * Store a newly created resource in storage.
     * @param CreateProduct $request
     * @return array
     */
    public function store(CreateProduct $request)
    {
        $products = $request->all();
        if (sizeof($products) === 1 && is_array(reset($products))) {
            return $this->productRepository->create(Product::make($products[0]))->toArray();
        }
        $this->productRepository->createMany($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return array
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

    public function massUpdate(Request $request)
    {
        $this->productRepository->updateMany($request->all());
    }

    public function getBetween(Request $request)
    {
        $startDate = new Carbon($request->get('start_date'));
        $endDate = new Carbon($request->get('end_date'));
        return $this->productRepository->getBetween($startDate, $endDate);
    }
}
