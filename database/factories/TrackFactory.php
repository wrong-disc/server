<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\track;
use Faker\Generator as Faker;

$factory->define(track::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(2),
        
    ];
});
