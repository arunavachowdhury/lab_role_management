<?php

use Faker\Generator as Faker;

$factory->define(App\UOM::class, function (Faker $faker) {
    return [
        'unit'=>$faker->word
    ];
});
