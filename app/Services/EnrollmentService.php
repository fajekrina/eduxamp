<?php

namespace App\Services;

use App\Repositories\EnrollmentRepository;
use App\Services\StudentService;
use App\Services\MajorService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EnrollmentService
{
    protected $studentService;
    protected $majorService;
    protected $enrollmentRepository;

    public function __construct(
        EnrollmentRepository $enrollmentRepository,
        StudentService $studentService,
        MajorService $majorService
    ) {
        $this->enrollmentRepository = $enrollmentRepository;
        $this->studentService = $studentService;
        $this->majorService = $majorService;
    }

    public function getAll()
    {
        return $this->enrollmentRepository->getAll();
    }

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {

            $student = $this->studentService->find($data['student_id']);

            if (!$student)
                throw new \Exception('Student not found.');

            $major = $this->majorService->find($data['major_id']);

            if (!$major)
                throw new \Exception('Major not found.');

            $data['student_number_snapshot'] = $student->student_number;
            $data['student_name_snapshot'] = $student->full_name;

            $data['major_code_snapshot'] = $major->major_code;
            $data['major_name_snapshot'] = $major->major_name;

            $data['enrollment_number'] = 'ENR-' . now()->format('YmdHis') . '-' . Str::upper(Str::random(5));
            $data['enrollment_date'] = now();

            return $this->enrollmentRepository->create($data);

        });
    }

    public function find($id)
    {
        return DB::transaction(function () use ($id) {

            return $this->enrollmentRepository->find($id);

        });
    }

    public function update($id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {

            return $this->enrollmentRepository->update($id, $data);

        });
    }

    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {

            return $this->enrollmentRepository->delete($id);

        });
    }

    public function history($id)
    {
        return $this->enrollmentRepository->history($id);
    }
}