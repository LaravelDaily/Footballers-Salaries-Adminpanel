<?php

$factory->define(App\Salary::class, function (Faker\Generator $faker) {
    return [
        "player_id" => factory('App\Player')->create(),
        "team_id" => factory('App\Team')->create(),
        "season_id" => factory('App\Season')->create(),
        "salary" => $faker->randomNumber(2),
    ];
});
