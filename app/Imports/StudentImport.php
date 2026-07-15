<?php

namespace App\Imports;

use App\Services\StudentService;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class StudentImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        $rows->shift();

        $studentService = app(StudentService::class);

        foreach ($rows as $row) {

            $studentService->store([
                'full_name' => $row[0],
                'gender' => $row[1],
                'birth_date' => $row[2],
                'email' => $row[3],
                'phone' => $row[4],
                'address' => $row[5],
                'is_active' => $row[6],
            ]);

        }
    }
}