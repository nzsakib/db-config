<?php

use Faker\Generator as Faker;
use Nzsakib\DbConfig\Models\Configuration;

$factory->define(Configuration::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'value' => $faker->sentence,
        'concat' => false,
    ];
});
