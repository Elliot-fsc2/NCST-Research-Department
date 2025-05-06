<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $firstNames = ['Emma', 'Liam', 'Olivia', 'Noah', 'Ava', 'Ethan', 'Sophia', 'Mason', 'Isabella', 'William'];
        $middleNames = ['Marie', 'James', 'Rose', 'John', 'Grace', 'Michael', 'Anne', 'Robert', 'Mae', 'Joseph'];
        $lastNames = ['Johnson', 'Brown', 'Davis', 'Miller', 'Wilson', 'Moore', 'Taylor', 'Anderson', 'Thomas', 'Jackson'];

        for ($i = 1; $i <= 50; $i++) {
            $firstName = $firstNames[array_rand($firstNames)];
            $middleName = $middleNames[array_rand($middleNames)];
            $lastName = $lastNames[array_rand($lastNames)];

            User::create([
                'first_name' => $firstName,
                'middle_name' => $middleName,
                'last_name' => $lastName,
                'email' => strtolower($lastName . '.' . $firstName . $i . '@ncst.edu.ph'),
                'password' => Hash::make('password'),
                'role' => 'student',
                'department_id' => 1,
            ]);
        }
    }
}