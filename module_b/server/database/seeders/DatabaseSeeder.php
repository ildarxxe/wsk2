<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\UserController::factory(10)->create();

         User::query()->create([
             'name' => 'admin',
             'password' => Hash::make('adminpass'),
         ]);
         User::query()->create([
             'name' => 'user1',
             'password' => Hash::make('user1pass'),
         ]);
         User::query()->create([
             'name' => 'user2',
             'password' => Hash::make('user2pass'),

         ]);
        Role::query()->create([
            'user_id' => 1,
            'role' => 'admin'
        ]);
        Role::query()->create([
            'user_id' => 2,
            'role' => 'user'
        ]);
        Role::query()->create([
            'user_id' => 3,
            'role' => 'user'
        ]);
    }
}
