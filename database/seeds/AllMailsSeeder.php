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
        /*factory(\App\EMail::class, 400)->create();
        factory(\App\User::class, 10)->create();
        \App\User::create([
            'name' => 'Eduardo Andres Machaca Peña',
            'first_name' => 'Eduardo',
            'last_name' => 'Machaca',
            'email' => 'eamachaca@hotmail.com',
            'user' => 'DeIt0',
            'password' => bcrypt('deitodeito'),
            'remember_token' => str_random(10),
        ]);*/
        $users = \App\User::all();
        //factory(\App\Roster::class, 1500)->create();
        $users->each(function ($user) {
            factory(\App\Mail::class, 1500)->create(['user_id' => $user->id]);
        });
    }
}
