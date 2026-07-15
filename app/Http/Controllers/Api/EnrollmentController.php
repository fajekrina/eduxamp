<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\EnrollmentService;
use Illuminate\Http\Request;
use Throwable;

class EnrollmentController extends Controller
{
    protected $EnrollmentService;

    public function __construct(EnrollmentService $EnrollmentService)
    {
        $this->EnrollmentService = $EnrollmentService;
    }

    public function getAll()
    {
        return response()->json([
            'success' => true,
            'message' => 'Enrollments retrieved successfully.',
            'data' => $this->EnrollmentService->getAll(),
        ]);
    }

    public function find($id, Request $request)
    {
        try {
            $enrollment = $this->EnrollmentService->find($id);

            return response()->json([
                'success' => true,
                'message' => 'Enrollment updated successfully.',
                'data' => $enrollment,
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
            $enrollment = $this->EnrollmentService->store($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Enrollment created successfully.',
                'data' => $enrollment,
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
            $enrollment = $this->EnrollmentService->update($id, $request->all());

            return response()->json([
                'success' => true,
                'message' => 'Enrollment updated successfully.',
                'data' => $enrollment,
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

            $this->EnrollmentService->destroy($id);

            return response()->json([
                'success' => true,
                'message' => 'Enrollment deleted successfully.',
            ]);

        } catch (Throwable $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);

        }
    }

    public function history($id)
    {
        try {

            return response()->json([
                'success' => true,
                'data' => $this->EnrollmentService->history($id),
            ]);

        } catch (\Throwable $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);

        }
    }
}