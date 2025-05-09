<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Department;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $courses = [
            'Computer Studies' => [
                ['code' => 'BSIT', 'name' => 'Bachelor of Science in Information Technology'],
                ['code' => 'BSCS', 'name' => 'Bachelor of Science in Computer Science'],
            ],
            'Education' => [
                ['code' => 'BSED', 'name' => 'Bachelor of Secondary Education'],
                ['code' => 'BEED', 'name' => 'Bachelor of Elementary Education'],
            ],
            'Criminal Justice' => [
                ['code' => 'BSCrim', 'name' => 'Bachelor of Science in Criminology'],
            ],
            'Accounting' => [
                ['code' => 'BSA', 'name' => 'Bachelor of Science in Accountancy'],
            ],
        ];

        foreach ($courses as $departmentName => $departmentCourses) {
            $department = Department::where('name', $departmentName)->first();
            
            foreach ($departmentCourses as $course) {
                Course::create([
                    'department_id' => $department->id,
                    'code' => $course['code'],
                    'name' => $course['name'],
                ]);
            }
        }
    }
}