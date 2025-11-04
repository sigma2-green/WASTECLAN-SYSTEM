<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        /*$admins = [
            [
                'name' => 'Denzel',
                'email' => 'denzelomondi23@gmail.com',
                'phone' => '0706441167',
            ],
            [
                'name' => 'Gideon',
                'email' => 'gideon@example.com',
                'phone' => '0712345678',
            ],
            [
                'name' => 'Ezekiel',
                'email' => 'mercy@example.com',
                'phone' => '0722334455',
            ],
            [
                'name' => 'Adrian',
                'email' => 'faith@example.com',
                'phone' => '0733445566',
            ],
            [
                'name' => 'Corban',
                'email' => 'kevin@example.com',
                'phone' => '0744556677',
            ],
        ];

        foreach ($admins as $admin) {
            User::updateOrCreate(
                ['email' => $admin['email']], // avoid duplicates
                [
                    'name' => $admin['name'],
                    'phone' => $admin['phone'],
                    'role' => 'admin',
                    'password' => Hash::make('1234'), // hashed password
                ]
            );
        }
            */
    }
}

 