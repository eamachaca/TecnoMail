<?php

use Faker\Generator as Faker;

$factory->define(\App\Roster::class, function (Faker $faker) {
    $name_folder_id = '';
    if (\App\FolderName::all()->count() === 4 || $faker->boolean(5)) {
        $name_folder_id = \App\FolderName::firstOrCreate(['name' => substr($faker->slug, 0, 20)])->id;
    } else {
        if ($faker->boolean(10))
            $name_folder_id = rand(4, \App\FolderName::all()->count());
        else
            $name_folder_id = 4;
    }
    $user_id = \App\User::all()->random()->id;
    $folder_id = \App\Folder::firstOrCreate([
        'folder_name_id' => $name_folder_id,
        'user_id' => $user_id
    ])->id;
    return ['data' => $faker->firstName,
        'user_id' => $user_id,
        'folder_id' => $folder_id,
    ];
});
