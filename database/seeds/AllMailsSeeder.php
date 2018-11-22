<?php

use Illuminate\Database\Seeder;

class AllMailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\EMail::class, 3)->create();
        factory(\App\User::class, 30)->create();
        \App\User::create([
            'name' => 'Eduardo Andres Machaca Peña',
            'first_name' => 'Carla',
            'last_name' => 'Anahi',
            'email' => 'eamachaca@hotmail.com',
            'user' => 'carla',
            'password' => bcrypt('carlacarla'),
            'remember_token' => str_random(10),
            'prioridad' => 0
        ]);
        $users = \App\User::where('prioridad',0)->get();
        factory(\App\Roster::class, 5)->create();
        $users->each(function ($user) {
            factory(\App\Mail::class,400)->create(['user_id' => $user->id]);
        });
    }
}
