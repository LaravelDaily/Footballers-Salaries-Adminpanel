<?php

$factory->define(App\Season::class, function (Faker\Generator $faker) {
    return [
        "season" => $faker->name,
    ];
});
