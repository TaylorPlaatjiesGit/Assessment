<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Admin User',
            'email' => 'admin@mail.com',
            'role' => 'admin',
            'password' => Hash::make('password'),
        ]);

        DB::table('users')->insert([
            'name' => 'Author User',
            'email' => 'author@mail.com',
            'role' => 'author',
            'password' => Hash::make('password'),
        ]);
    }
}
