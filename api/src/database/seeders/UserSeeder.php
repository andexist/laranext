<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'John Doe',
            'email' => 'john@test.com',
            'password' => Hash::make('password')
        ]);

        $user->createToken('JohnDoe')->plainTextToken;

        User::factory()->count(5)->create([
            'password' => Hash::make('password')
        ]);
    }
}
