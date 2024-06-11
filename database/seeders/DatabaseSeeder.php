<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name'     => 'Filament',
            'email'    => 'test@filamentphp.com',
            'password' => 'password',
        ]);

        Customer::factory(rand(5, 10))
                ->has(Post::factory(rand(5, 10)), 'posts')
                ->create();
    }
}
