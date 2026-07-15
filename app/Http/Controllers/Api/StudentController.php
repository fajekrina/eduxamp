<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\StudentService;
use Illuminate\Http\Request;
use Throwable;

class StudentController extends Controller
{
    protected $StudentService;

    public function __construct(StudentService $StudentService)
    {
        $this->StudentService = $StudentService;
    }

    public function getAll()
    {
        return response()->json([
            'success' => true,
            'message' => 'Students retrieved successfully.',
            'data' => $this->StudentService->getAll(),
        ]);
    }

    public function find($id, Request $request)
    {
        try {
            $student = $this->StudentService->find($id);

            return response()->json([
                'success' => true,
                'message' => 'Student updated successfully.',
                'data' => $student,
            ]);

        } catch (Throwable $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);

        }
    }

    public function store(Request $request)
    {
        try {
            $student = $this->StudentService->store($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Student created successfully.',
                'data' => $student,
            ], 201);

        } catch (Throwable $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);

        }
    }

    public function update($id, Request $request)
    {
        try {
            $student = $this->StudentService->update($id, $request->all());

            return response()->json([
                'success' => true,
                'message' => 'Student updated successfully.',
                'data' => $student,
            ]);

        } catch (Throwable $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);

        }
    }

    public function destroy($id)
    {
        try {

            $this->StudentService->destroy($id);

            return response()->json([
                'success' => true,
                'message' => 'Student deleted successfully.',
            ]);

        } catch (Throwable $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);

        }
    }

    public function export(Request $request)
    {
        $request->validate([
            'columns'=>'required|array|min:1'
        ]);

        $filename = $this->StudentService
            ->export($request->columns);

        return response()->json([
            'success'=>true,
            'message'=>'Export is running in background.',
            'filename'=>$filename
        ]);
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        $this->StudentService->import($request->file('file'));

        return response()->json([
            'success' => true,
            'message' => 'Import has been queued.'
        ]);
    }

    public function exportStatus($filename)
    {
        $path = storage_path('app/public/exports/' . $filename);

        return response()->json([
            'ready' => file_exists($path),
            'url' => asset('storage/exports/' . $filename)
        ]);
    }
}