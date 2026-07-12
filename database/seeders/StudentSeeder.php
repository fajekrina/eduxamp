<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Student::create([
            'uuid' => Str::uuid(),
            'user_id' => 2,
            'student_number' => 'Administrator',
            'full_name' => 'Administrator',
            'gender' => 'Male',
            'birth_date' => '2001-11-10',
            'phone' => '0895755603668',
            'address' => 'Surabaya',
            'gender' => 'Male',
            'email' => 'johndoe@eduxamp.id',
            'is_active' => true,
        ]);
    }
}
