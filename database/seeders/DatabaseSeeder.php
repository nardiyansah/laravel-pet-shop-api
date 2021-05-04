<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\User;
use App\Models\Category;
use App\Models\Item;

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
            'image' => 'http://192.168.43.15:8000/users/admin.jpg',
            'password' => 'password',
            'email' => 'admin@gmail.com',
            'phone' => '083456678910',
            'role' => 'admin',
            'address' => 'jln. kenangan'
        ]);

        $user->create([
            'name' => 'user',
            'image' => 'http://192.168.43.15:8000/users/user.jpg',
            'password' => 'password',
            'email' => 'user@gmail.com',
            'phone' => '083345673214',
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

        // seed items tables
        $item = new Item;

        $item->create([
            'category_id' => 1,
            'name' => 'Royal Canin',
            'image' => url('/items/rc-persian.png'),
            'detail' => 'Persian 2 kg', //ini untuk varian dan sejenisnya
            'price' => 250000,
            'stok' => 5,
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Venenatis, ultrices etiam id at id. Volutpat non facilisi consectetur ullamcorper hendrerit tortor suscipit quis. Sem eu amet nunc et, aliquet consectetur. Libero lobortis diam sapien vitae. Sollicitudin eget nisl urna vivamus quis.'
        ]);

    }
}
