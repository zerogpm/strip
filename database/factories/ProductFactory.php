<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'price' => 10 + mt_rand() / mt_getrandmax() * (60 - 10),
    ];
});
