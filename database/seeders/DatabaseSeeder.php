<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()->create([
            'id' => 1,
            'name' => 'Admin',
            'email' => 'admin@blog.com',
        ]);

        // \App\Models\User::factory(10)->hasPosts(5)->create();
    }
}
