<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "Admin",
            'email' => "admin@wrongdisc.com",
            'password' => Hash::make("password123"),
            'role' => "admin"
        ]);

        DB::table('users')->insert([
            'name' => "Editor",
            'email' => "editor@wrongdisc.com",
            'password' => Hash::make("password123"),
            'role' => "editor"
        ]);

        DB::table('users')->insert([
            'name' => "User",
            'email' => "user@wrongdisc.com",
            'password' => Hash::make("password123"),
        ]);
    }
}