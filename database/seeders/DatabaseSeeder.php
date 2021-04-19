<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\User;

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

        $user->name = 'admin1';
        $user->password = 'password';
        $user->email = 'admin@gmail.com';
        $user->role = 'admin';
        $user->address = 'jln. kenangan';

        $user->save();
    }
}
