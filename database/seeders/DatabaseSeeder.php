<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\User;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // seed admin to user table
        $user = new User;

        $user->create([
            'name' => 'admin',
            'password' => 'password',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'address' => 'jln. kenangan'
        ]);

        $user->create([
            'name' => 'user',
            'password' => 'password',
            'email' => 'user@gmail.com',
            'role' => 'user',
            'address' => 'jln. kenangan'
        ]);

        // seed to categories table
        $category = new Category;

        $category->create([
            'name' => 'food',
            'image' => url('/categories/feed.png')
        ]);

        $category->create([
            'name' => 'accesories',
            'image' => url('/categories/collar.png')
        ]);

        $category->create([
            'name' => 'equipment',
            'image' => url('/categories/home.png')
        ]);

        $category->create([
            'name' => 'medicine',
            'image' => url('/categories/medical.png')
        ]);
    }
}
