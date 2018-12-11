<?php

use Faker\Generator as Faker;
use App\Sample;
use App\UOM;
use App\TestItem;

$factory->define(App\TestItem::class, function (Faker $faker) {
    $sample = Sample::all()->random();
    $unit = UOM::all()->random();
    return [
        'name'=> $faker->word,
        'sample_id'=> $sample->id,
        'unit_id'=> $unit->id,
        'specified_value'=> $faker->numberBetween(20, 500),
        'description'=> $faker->paragraph(1),
        'is_new'=> $faker->randomElement(TestItem::IS_NEW, TestItem::NOT_NEW)
    ];
});
