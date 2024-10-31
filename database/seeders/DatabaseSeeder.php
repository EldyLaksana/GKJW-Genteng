<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'isAdmin' => '1',
            'password' => bcrypt('@Admin123'),
        ]);

        User::create([
            'name' => 'Test1',
            'username' => 'test1',
            'isAdmin' => '0',
            'password' => bcrypt('Test1@123'),
        ]);
    }
}
