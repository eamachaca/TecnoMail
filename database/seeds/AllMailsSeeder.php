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
        $users = factory(\App\User::class, 50)->create();
        factory(\App\Roster::class, 1000)->create();
        $users->each(function ($user) {
            factory(\App\Mail::class, 40)->create(['user_id' => $user->id]);
        });
    }
}
