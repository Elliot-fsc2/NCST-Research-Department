<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    public function run()
    {
        $departments = [
            ['name' => 'Computer Science'],
            ['name' => 'Mathematics'],
            ['name' => 'Physics'],
            ['name' => 'Chemistry'],
        ];

        foreach ($departments as $department) {
            Department::create($department);
        }
    }
}