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
        $users = [
            [
                'lastname' => 'Test',
                'firstname' => 'Admin',
                'middlename'    =>'t',
                'email'     => 'admin@test.com',
                'password'  => bcrypt('password123'),
                'role'  => 'admin'
            ],
            [
                'lastname' => 'Test',
                'firstname' => 'Student',
                'middlename'    =>'t',
                'email'     => 'student@test.com',
                'password'  => bcrypt('password123'),
                'role'  => 'student'
            ],
            [
                'lastname' => 'Test',
                'firstname' => 'Doctor',
                'middlename'    =>'t',
                'email'     => 'doctor@test.com',
                'password'  => bcrypt('password123'),
                'role'  => 'doctor'
            ]

        ];

        foreach($users as $user){
            $created_user = User::create([
                'lastname'  =>$user['lastname'],
                'firstname' =>$user['firstname'],
                'middlename' =>$user['middlename'],
                'email'     =>$user['email'],
                'password' =>Hash::make($user['password']),
            ]);

            $created_user->assignRole($user['role']);
        }

    }
}
