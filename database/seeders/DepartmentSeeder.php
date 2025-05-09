<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        $departments = [
            ['name' => 'Computer Studies'],
            ['name' => 'Education'],
            ['name' => 'Criminal Justice'],
            ['name' => 'Accounting'],
        ];

        foreach ($departments as $department) {
            Department::create($department);
        }
    }
}