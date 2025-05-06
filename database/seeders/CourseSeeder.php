<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Department;

class CourseSeeder extends Seeder
{
    public function run()
    {
        $departments = Department::all()->keyBy('name');

        $courses = [
            ['name' => 'Algorithms', 'department' => 'Computer Science'],
            ['name' => 'Linear Algebra', 'department' => 'Mathematics'],
            ['name' => 'Quantum Mechanics', 'department' => 'Physics'],
            ['name' => 'Organic Chemistry', 'department' => 'Chemistry'],
        ];

        foreach ($courses as $course) {
            if (isset($departments[$course['department']])) {
                Course::create([
                    'name' => $course['name'],
                    'department_id' => $departments[$course['department']]->id,
                ]);
            }
        }
    }
}