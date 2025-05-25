<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Role;
use App\Models\Token;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::query()->create([
            'name' => 'user',
        ]);
        Role::query()->create([
            'name' => 'admin',
        ]);

        User::query()->create([
            'username' => 'admin',
            'password' => Hash::make('adminpass'),
            'role_id' => 2,
        ]);
        User::query()->create([
            'username' => 'user1',
            'password' => Hash::make('adminpass'),
            'role_id' => 1,
        ]);
        User::query()->create([
            'username' => 'user2',
            'password' => Hash::make('user2pass'),
            'role_id' => 1,
        ]);

        Token::query()->create([
            'user_id' => 1,
            'token' => Str::random(30)
        ]);
        Token::query()->create([
            'user_id' => 2,
            'token' => Str::random(30)
        ]);
        Token::query()->create([
            'user_id' => 3,
            'token' => Str::random(30)
        ]);
    }
}
