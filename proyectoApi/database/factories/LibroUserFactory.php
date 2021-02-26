<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\LibroUser;
use Faker\Generator as Faker;

$factory->define(LibroUser::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween($min = 1, $max = 20) ,
        'libro_id' => $faker->numberBetween($min = 1, $max = 40) ,
    ];
});
