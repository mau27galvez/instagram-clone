<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Image;
use Faker\Generator as Faker;

$factory->define(Image::class, function (Faker $faker) {
    return [
        'path' => $faker->image(),
        'user_id' => 1,
        'description' => $faker->text(500)
    ];
});
