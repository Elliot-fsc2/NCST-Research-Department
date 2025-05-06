<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Department;
use App\Models\Course;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $csDept = Department::where('name', 'Computer Science')->first();
        $mathDept = Department::where('name', 'Mathematics')->first();
        $algoCourse = Course::where('name', 'Algorithms')->first();
        $laCourse = Course::where('name', 'Linear Algebra')->first();

        // Research Head
        User::create([
            'first_name' => 'John',
            'last_name' => 'Martinez',
            'role' => 'head',
            'email' => 'martinez.john@ncst.edu.ph',
            'password' => Hash::make('martinez'),
            'department_id' => $csDept?->id,
        ]);

        // Professors
        User::create([
            'first_name' => 'Robert',
            'last_name' => 'Santos',
            'role' => 'professor',
            'email' => 'santos.robert@ncst.edu.ph',
            'password' => Hash::make('santos'),
            'department_id' => $csDept?->id,
            'course_id' => $algoCourse?->id,
        ]);

        User::create([
            'first_name' => 'Maria',
            'last_name' => 'Cruz',
            'role' => 'professor',
            'email' => 'cruz.maria@ncst.edu.ph',
            'password' => Hash::make('cruz'),
            'department_id' => $mathDept?->id,
            'course_id' => $laCourse?->id,
        ]);

        // Students
        $students = [
            [
                'first_name' => 'Anna',
                'last_name' => 'Garcia',
                'department_id' => $csDept?->id,
                'course_id' => $algoCourse?->id,
                'student_number' => '2023-00001',
            ],
            [
                'first_name' => 'Miguel',
                'last_name' => 'Reyes',
                'department_id' => $mathDept?->id,
                'course_id' => $laCourse?->id,
                'student_number' => '2023-00002',
            ],
            [
                'first_name' => 'Sofia',
                'last_name' => 'Torres',
                'department_id' => $csDept?->id,
                'course_id' => $algoCourse?->id,
                'student_number' => '2023-00003',
            ],
        ];

        foreach ($students as $student) {
            User::create([
                'first_name' => $student['first_name'],
                'last_name' => $student['last_name'],
                'role' => 'student',
                'student_number' => $student['student_number'],
                'email' => strtolower($student['last_name'] . '.' . $student['first_name'] . '@ncst.edu.ph'),
                'password' => Hash::make(strtolower($student['last_name'])),
                'department_id' => $student['department_id'],
                'course_id' => $student['course_id'],
            ]);
        }
    }
}