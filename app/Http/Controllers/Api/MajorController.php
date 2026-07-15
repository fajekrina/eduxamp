<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\MajorService;
use Illuminate\Http\Request;
use Throwable;

class MajorController extends Controller
{
    protected $MajorService;

    public function __construct(MajorService $MajorService)
    {
        $this->MajorService = $MajorService;
    }

    public function getAll()
    {
        return response()->json([
            'success' => true,
            'message' => 'Majors retrieved successfully.',
            'data' => $this->MajorService->getAll(),
        ]);
    }

    public function find($id, Request $request)
    {
        try {
            $major = $this->MajorService->find($id);

            return response()->json([
                'success' => true,
                'message' => 'Major updated successfully.',
                'data' => $major,
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
            $major = $this->MajorService->store($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Major created successfully.',
                'data' => $major,
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
            $major = $this->MajorService->update($id, $request->all());

            return response()->json([
                'success' => true,
                'message' => 'Major updated successfully.',
                'data' => $major,
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

            $this->MajorService->destroy($id);

            return response()->json([
                'success' => true,
                'message' => 'Major deleted successfully.',
            ]);

        } catch (Throwable $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);

        }
    }
}