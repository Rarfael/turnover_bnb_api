<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Product::class, function (Faker $faker) {
    $now = \Carbon\Carbon::now();
    return [
        'name' => $faker->word,
        'description' => $faker->sentence,
        'price' => $faker->numberBetween(1, 123456),
        'currency' => $faker->randomElement(['BRL', 'USD']),
        'created_at' => $now,
        'updated_at' => $now,
    ];
});
