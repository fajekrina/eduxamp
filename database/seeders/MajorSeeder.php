<?php

namespace Database\Seeders;

use App\Models\Major;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MajorSeeder extends Seeder
{
    public function run()
    {
        $majors = [
            [
                'uuid' => Str::uuid(),
                'major_code' => 'CS',
                'major_name' => 'Computer Science',
                'description' => 'Bachelor of Computer Science',
                'faculty' => 'Engineering',
                'is_active' => true,
            ],
            [
                'uuid' => Str::uuid(),
                'major_code' => 'IT',
                'major_name' => 'Information Technology',
                'description' => 'Bachelor of Information Technology',
                'faculty' => 'Engineering',
                'is_active' => true,
            ],
            [
                'uuid' => Str::uuid(),
                'major_code' => 'SE',
                'major_name' => 'Software Engineering',
                'description' => 'Bachelor of Software Engineering',
                'faculty' => 'Engineering',
                'is_active' => true,
            ],
            [
                'uuid' => Str::uuid(),
                'major_code' => 'BA',
                'major_name' => 'Business Administration',
                'description' => 'Bachelor of Business Administration',
                'faculty' => 'Business',
                'is_active' => true,
            ],
            [
                'uuid' => Str::uuid(),
                'major_code' => 'ACC',
                'major_name' => 'Accounting',
                'description' => 'Bachelor of Accounting',
                'faculty' => 'Business',
                'is_active' => true,
            ],
        ];

        foreach ($majors as $major) {
            Major::create($major);
        }
    }
}