<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Track;
use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(Track::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(2),
        'file' => $faker->sentence(2),
        'duration' => Carbon::createFromTimestamp(0)->addMinutes(2)->addSeconds(42),
        'total_plays' => '4',
        'album_index' => '5',
        'artist_id' => '1',
        'album_id' => '1',
    ];
});
