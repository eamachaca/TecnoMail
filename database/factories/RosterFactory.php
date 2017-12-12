<?php

use Faker\Generator as Faker;

$factory->define(\App\Roster::class, function (Faker $faker) {
    $name_folder_id = '';
    if (\App\FolderName::all()->count() === 4 || $faker->boolean(1)) {
        $name_folder_id = \App\FolderName::firstOrCreate(['name' => substr($faker->slug, 0, 20)])->id;
    } else {
        if ($faker->boolean(70))
            $name_folder_id = rand(4, \App\FolderName::all()->count());
        else
            $name_folder_id = 4;
    }
    $user_id = \App\User::all()->random()->id;
    $folder_id = \App\Folder::firstOrCreate([
        'folder_name_id' => $name_folder_id,
        'user_id' => $user_id
    ])->id;
    $word = $faker->word;
    while (strlen($word) < 3) {
        $word = $faker->word;
    }
    echo $word . PHP_EOL;
    return [
        'data' => $word,
        'user_id' => $user_id,
        'folder_id' => $folder_id,
    ];
});
