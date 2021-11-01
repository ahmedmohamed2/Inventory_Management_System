<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "user_name"     => "admin",
            "user_password" => Hash::make("123456"),
            "full_name"     => "System Administrator",
            "user_status"   => "1",
            "user_image"    => "default.png"
        ]);
    }
}
