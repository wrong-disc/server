<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Track;
use Faker\Generator as Faker;

$factory->define(Track::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(2),
        'name' => $faker->sentence(2),
        'file' => $faker->sentence(2),
        'total_plays' => '4',
        'album_index' => '5',
    ];
});
