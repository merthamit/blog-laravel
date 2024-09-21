<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->insert([
            'name' => 'Mert Hamit Koçer',
            'email' => 'merthamit@gmail.com',
            'password' => bcrypt(123456),
        ]);
    }
}
