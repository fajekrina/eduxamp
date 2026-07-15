<?php

namespace App\Services;

use App\Jobs\ExportStudentJob;
use App\Jobs\ImportStudentJob;
use App\Repositories\StudentRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class StudentService
{
    protected $StudentRepository;

    public function __construct(StudentRepository $StudentRepository)
    {
        $this->StudentRepository = $StudentRepository;
    }

    public function getAll()
    {
        return $this->StudentRepository->getAll();
    }

    private function generateStudentNumber(): string
    {
        $year = now()->format('Y');

        $lastStudent = $this->StudentRepository->getLastStudent();

        if ($lastStudent && str_starts_with($lastStudent->student_number, 'STD' . $year)) {
            $lastNumber = (int) substr($lastStudent->student_number, -5);
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }

        return sprintf('STD%s%05d', $year, $nextNumber);
    }

    public function store(array $data)
    {
        $filename = null;

        try {

            return DB::transaction(function () use (&$data, &$filename) {

                if (isset($data['transcript'])) {

                    $file = $data['transcript'];

                    $filename = time() . '_' . $file->getClientOriginalName();

                    $file->move(public_path('transcript'), $filename);

                    $data['transcript_file'] = $filename;
                }

                $data['student_number'] = $this->generateStudentNumber();

                return $this->StudentRepository->create($data);

            });

        } catch (\Throwable $e) {

            if (
                $filename &&
                file_exists(public_path('transcript/' . $filename))
            ) {
                unlink(public_path('transcript/' . $filename));
            }

            throw $e;
        }
    }

    public function find($id)
    {
        return $this->StudentRepository->find($id);
    }

    public function update($id, array $data)
    {
        $newFilename = null;
        $oldFilename = null;

        try {

            $student = $this->StudentRepository->find($id);

            $oldFilename = $student->transcript_file;

            if (isset($data['transcript'])) {

                $file = $data['transcript'];

                $newFilename = time() . '_' . $file->getClientOriginalName();

                $file->move(public_path('transcript'), $newFilename);

                $data['transcript_file'] = $newFilename;

                unset($data['transcript']);
            }

            $result = DB::transaction(function () use ($id, $data) {

                return $this->StudentRepository->update($id, $data);

            });

            if (
                $newFilename &&
                $oldFilename &&
                File::exists(public_path('transcript/' . $oldFilename))
            ) {
                File::delete(public_path('transcript/' . $oldFilename));
            }

            return $result;

        } catch (\Throwable $e) {

            if (
                $newFilename &&
                File::exists(public_path('transcript/' . $newFilename))
            ) {
                File::delete(public_path('transcript/' . $newFilename));
            }

            throw $e;
        }
    }

    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {

            $student = $this->StudentRepository->find($id);

            if (
                $student->transcript_file &&
                File::exists(public_path('transcript/' . $student->transcript_file))
            ) {
                File::delete(public_path('transcript/' . $student->transcript_file));
            }

            return $this->StudentRepository->delete($id);

        });
    }

    public function export(array $columns)
    {
        $filename = 'students_' . time() . '.xls';

        ExportStudentJob::dispatch($columns, $filename);

        return $filename;
    }

    public function import($file)
    {
        $filename = time().'_'.$file->getClientOriginalName();

        $file->move(storage_path('app/imports'), $filename);

        ImportStudentJob::dispatch($filename);
    }
}