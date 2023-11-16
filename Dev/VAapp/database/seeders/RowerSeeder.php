<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RowerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rowers')->insert([
            'last_name' => 'Doe',
            'first_name' => 'John',
            'phone_number' => '+68989507772',
            'email' => Str::random(10).'@gmail.com',
            'users_id' => 1,
        ]);
    }
}
