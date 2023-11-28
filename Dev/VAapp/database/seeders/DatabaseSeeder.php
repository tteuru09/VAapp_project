<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(2)->create([
            'status' => 'trainer'
        ]);
        \App\Models\User::factory(15)->create([
            'status' => 'rower'
        ]);
        \App\Models\User::factory()->create([
            'status' => 'admin'
        ]);
        \App\Models\Canoe::factory()->create([
            'numberOfPlace' => 6
        ]);
        \App\Models\Canoe::factory()->create([
            'numberOfPlace' => 3
        ]);
        \App\Models\Canoe::factory(2)->create([
            'numberOfPlace' => 1
        ]);
    }
}
