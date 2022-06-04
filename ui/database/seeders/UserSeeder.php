<?php

namespace Database\Seeders;

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
        $data = array(
            [
                'name' => 'User 1',
                'email' => 'user1@mail.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'User 2',
                'email' => 'user2@mail.com',
                'password' => Hash::make('password'),
            ],
        );

        foreach ($data as $item) {
            \App\Models\User::create($item);
        }
    }
}
