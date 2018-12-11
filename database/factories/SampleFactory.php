<?php

use Faker\Generator as Faker;
use App\Sample;

$factory->define(App\Sample::class, function (Faker $faker) {
    return [
        'name'=> $faker->name,
        'description'=> $faker->paragraph(1)
    ];
});


