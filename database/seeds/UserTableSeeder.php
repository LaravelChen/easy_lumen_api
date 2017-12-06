<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'John Doe',
            'phone' => '15861621206',
            'password' => app('hash')->make('johndoe'),
            'remember_token' => str_random(10),
        ]);
    }
}
