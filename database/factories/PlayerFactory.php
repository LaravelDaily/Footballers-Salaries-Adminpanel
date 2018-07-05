<?php

$factory->define(App\Player::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
        "birth_date" => $faker->date("Y-m-d", $max = 'now'),
        "nationality_id" => factory('App\Country')->create(),
    ];
});
