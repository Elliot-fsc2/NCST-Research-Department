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
        $csDept = Department::where('name', 'Computer Studies')->first();
        $eduDept = Department::where('name', 'Education')->first();
        $crimDept = Department::where('name', 'Criminal Justice')->first();
        $accDept = Department::where('name', 'Accounting')->first();

        $bsitCourse = Course::where('code', 'BSIT')->first();
        $bsedCourse = Course::where('code', 'BSED')->first();
        $bscrimCourse = Course::where('code', 'BSCrim')->first();
        $bsaCourse = Course::where('code', 'BSA')->first();

        // Research Head
        User::create([
            'first_name' => 'John',
            'last_name' => 'Martinez',
            'role' => 'head',
            'email' => 'martinez.john@ncst.edu.ph',
            'password' => Hash::make('martinez'),
            'department_id' => $csDept?->id,
            'is_active' => true,
        ]);

        // Professors
        $professors = [
            [
                'first_name' => 'Robert',
                'last_name' => 'Santos',
                'department_id' => $csDept?->id,
                'course_id' => $bsitCourse?->id,
            ],
            [
                'first_name' => 'Maria',
                'last_name' => 'Cruz',
                'department_id' => $eduDept?->id,
                'course_id' => $bsedCourse?->id,
            ],
            [
                'first_name' => 'Ricardo',
                'last_name' => 'Dela Cruz',
                'department_id' => $crimDept?->id,
                'course_id' => $bscrimCourse?->id,
            ],
            [
                'first_name' => 'Elena',
                'last_name' => 'Reyes',
                'department_id' => $accDept?->id,
                'course_id' => $bsaCourse?->id,
            ],
        ];

        foreach ($professors as $professor) {
            User::create([
                'first_name' => $professor['first_name'],
                'last_name' => $professor['last_name'],
                'role' => 'professor',
                'email' => strtolower($professor['last_name'] . '.' . $professor['first_name'] . '@ncst.edu.ph'),
                'password' => Hash::make(strtolower($professor['last_name'])),
                'department_id' => $professor['department_id'],
                'course_id' => $professor['course_id'],
                'is_active' => true,
            ]);
        }

        // Students
        $students = [
            [
                'first_name' => 'Anna',
                'last_name' => 'Garcia',
                'department_id' => $csDept?->id,
                'course_id' => $bsitCourse?->id,
                'student_number' => '2023-00001',
            ],
            [
                'first_name' => 'Miguel',
                'last_name' => 'Reyes',
                'department_id' => $eduDept?->id,
                'course_id' => $bsedCourse?->id,
                'student_number' => '2023-00002',
            ],
            [
                'first_name' => 'Sofia',
                'last_name' => 'Torres',
                'department_id' => $crimDept?->id,
                'course_id' => $bscrimCourse?->id,
                'student_number' => '2023-00003',
            ],
            [
                'first_name' => 'Marco',
                'last_name' => 'Luna',
                'department_id' => $accDept?->id,
                'course_id' => $bsaCourse?->id,
                'student_number' => '2023-00004',
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
                'is_active' => true,
            ]);
        }
    }
}