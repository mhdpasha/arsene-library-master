<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            [
                'id' => 1,
                'name' => 'Muhamad Pasha Albara',
                'email' => 'pashaalbara01@gmail.com',
                'password' => Hash::make('pasha'),
                'phone' => '085777511106',
                'location' => 'Jl. Nangka no. 18',
                'about_me' => 'I code things',
                'pustakawan' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 2,
                'name' => 'Muhamad Hanafi',
                'email' => 'napi@gmail.com',
                'password' => Hash::make('pasha'),
                'phone' => '085777511106',
                'location' => 'Jl. Nanas no. 12',
                'about_me' => 'Aku wibu',
                'pustakawan' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ]

            ]);
    }
}
