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
        factory(\App\EMail::class, 20)->create();
        //factory(\App\User::class, 3)->create();
        \App\User::create([
            'name' => 'Eduardo Andres Machaca Peña',
            'first_name' => 'Eduardo',
            'last_name' => 'Machaca',
            'email' => 'eamachaca@hotmail.com',
            'user' => 'deito',
            'password' => bcrypt('deito'),
            'remember_token' => str_random(10),
            'prioridad' => 0
        ]);
        $users = \App\User::all();
        factory(\App\Roster::class, 5)->create();
        $users->each(function ($user) {
            factory(\App\Mail::class,500)->create(['user_id' => $user->id]);
        });
    }
}
