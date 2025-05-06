<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentAndCourseSeeder extends Seeder
{
    public function run(): void
    {
        // College of Computing Studies
        $ccs = Department::create([
            'name' => 'College of Computing Studies',
            'code' => 'CCS',
        ]);

        Course::create([
            'department_id' => $ccs->id,
            'name' => 'Bachelor of Science in Information Technology',
            'code' => 'BSIT',
        ]);

        Course::create([
            'department_id' => $ccs->id,
            'name' => 'Bachelor of Science in Computer Science',
            'code' => 'BSCS',
        ]);

        // College of Engineering
        $coe = Department::create([
            'name' => 'College of Engineering',
            'code' => 'COE',
        ]);

        Course::create([
            'department_id' => $coe->id,
            'name' => 'Bachelor of Science in Civil Engineering',
            'code' => 'BSCE',
        ]);

        Course::create([
            'department_id' => $coe->id,
            'name' => 'Bachelor of Science in Mechanical Engineering',
            'code' => 'BSME',
        ]);

        Course::create([
            'department_id' => $coe->id,
            'name' => 'Bachelor of Science in Electrical Engineering',
            'code' => 'BSEE',
        ]);

        // College of Business
        $cob = Department::create([
            'name' => 'College of Business',
            'code' => 'COB',
        ]);

        Course::create([
            'department_id' => $cob->id,
            'name' => 'Bachelor of Science in Business Administration',
            'code' => 'BSBA',
        ]);

        Course::create([
            'department_id' => $cob->id,
            'name' => 'Bachelor of Science in Accountancy',
            'code' => 'BSA',
        ]);
    }
}