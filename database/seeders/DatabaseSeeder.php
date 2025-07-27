<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Phone;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // User::factory(50)->create();
        // Blog::factory(100)->create();
        Phone::truncate();
        Phone::factory(20)->create();


        // $this->call([
        //     UserSeeder::class,
        //     BlogSeeder::class,
        // ]);
    }
}
