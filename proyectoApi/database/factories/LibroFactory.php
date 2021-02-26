<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Libro;
use Faker\Generator as Faker;

$factory->define(Libro::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'description' => $faker->paragraph($nbSentences = 2, $variableNbSentences = true),
    ];
});
