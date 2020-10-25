<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use \Carbon\Carbon;

$factory->define(\App\Product::class, function (Faker $faker) {
    $now = Carbon::now();
    return [
        'name' => $faker->word,
        'description' => $faker->sentence,
        'price' => $faker->numberBetween(1, 123456),
        'currency' => $faker->randomElement(['BRL', 'USD']),
    ];
});
