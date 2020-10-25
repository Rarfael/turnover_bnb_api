<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'description', 'price', 'currency'];

    public function createMany(array $products): bool
    {
        $now = Carbon::now()->toDateTimeLocalString();
        $timestamp = ['created_at'=> $now, 'updated_at' => $now];
        $productsWithTimestamp = array_map(fn($product) => array_merge($product, $timestamp), $products);
        return self::query()->insert($productsWithTimestamp);
    }
}
