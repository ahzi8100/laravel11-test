<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('blogs')->insert([
        //     'title' => 'Blog 1',
        //     'description' => 'Ini adalah description untuk blog 1',
        //     'user_id' => 1,
        // ]);

        DB::table('blogs')->truncate();

        for ($i = 1; $i <= 100; $i++) {
            DB::table('blogs')->insert([
                'title' => "Blog $i",
                'description' => "Ini adalah description untuk blog $i",
                'user_id' => 1,
            ]);
        }
    }
}
