<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\album;
use Faker\Generator as Faker;

$factory->define(album::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(2),
        'cover' => 'https://upload.wikimedia.org/wikipedia/pt/7/79/The_Evolution_of_Man_de_Example.jpg',

    ];
});
