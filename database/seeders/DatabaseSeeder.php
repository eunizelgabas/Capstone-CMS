<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'lastname' => 'Test',
            'firstname' => 'Admin',
            'middlename' =>'t',
            'email'     => 'admin@test.com',
            'gender'    => 'Female',
            'contact_no'=> "09123456789",
            'password'  => bcrypt('password123'),
        ]);

        \App\Models\User::factory()->create([
            'lastname' => 'Test',
            'firstname' => 'Student',
            'middlename'    =>'t',
            'gender'    => 'Male',
            'contact_no'=> "09123456789",
            'email'     => 'student@test.com',
            'password'  => bcrypt('password123'),
        ]);

        \App\Models\User::factory()->create([
            'lastname' => 'Test',
            'firstname' => 'Doctor',
            'middlename'    =>'t',
            'gender'    => 'Female',
            'contact_no'=> "09123456789",
            'email'     => 'doctor@test.com',
            'password'  => bcrypt('password123'),
        ]);
        $this->call([
            RolesSeeder::class,
            // UserSeeder::class
        ]);
    }
}
