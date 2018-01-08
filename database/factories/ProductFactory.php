<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'name'        => $faker->name,
        'price'       => rand(1000, 8000),
        'description' => $faker->sentence()
    ];
});
