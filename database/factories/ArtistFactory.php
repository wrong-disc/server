<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\artist;
use Faker\Generator as Faker;

$factory->define(artist::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'photo' => 'https://images.unsplash.com/photo-1549349807-4575e87c7e6a?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&w=1000&q=80',
    ];
});
