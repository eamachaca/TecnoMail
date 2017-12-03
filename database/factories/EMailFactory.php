<?php

use Faker\Generator as Faker;

$factory->define(\App\EMail::class, function (Faker $faker) {
    return [
        'e_mail' => $faker->email,
        'name' => $faker->name(),
    ];
});
