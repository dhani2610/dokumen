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
            'id' => 1,
            'stambuk' => '99999999',
            'name' => 'Superadmin',
            'email' => 'superadmin@gmail.com',
            'phone' => '08921738278',
            'password' => Hash::make('secret'),
            'role' => 'Superadmin',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
