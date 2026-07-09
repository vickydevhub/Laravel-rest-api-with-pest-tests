<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'John Doe',
            'email' => 'john@test.com',
            'password' => Hash::make('wwe12345'),
        ]);

        User::create([
            'name' => 'Jane Doe',
            'email' => 'jane@test.com',
            'password' => Hash::make('123456789'),
        ]);

        User::factory(7)->create();
    }
}
