<?php

use Faker\Generator as Faker;

$factory->define(\App\Mail::class, function (Faker $faker) {
    $user = \App\User::all()->random();
    return [
        'subject' => substr($faker->slug, 0, 50),
        'body' => '<h1> hola ' . $faker->realText() . '</h1>',
        'sended' => $faker->boolean(),
        'readed' => $faker->boolean(70),
        'user_id' => $user->id,
        'e_mail_id' => \App\EMail::all()->random()->id,

    ];
});
