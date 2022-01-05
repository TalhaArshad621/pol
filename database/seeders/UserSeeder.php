<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => "admin",
            'email' => "admin@demo.com",
            'email_verified_at' => now(),
            'password' => Hash::make('123'), // 123
            'remember_token' => Str::random(10),
        ]);
        $admin->assignRole('admin');
    }
}
