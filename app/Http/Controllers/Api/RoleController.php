<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\RoleService;
use Illuminate\Http\Request;
use Throwable;

class RoleController extends Controller
{
    protected $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function getAll()
    {
        return response()->json([
            'success' => true,
            'message' => 'Roles retrieved successfully.',
            'data' => $this->roleService->getAll(),
        ]);
    }

    public function find($id, Request $request)
    {
        try {
            $role = $this->roleService->find($id);

            return response()->json([
                'success' => true,
                'message' => 'Role updated successfully.',
                'data' => $role,
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
            $role = $this->roleService->store($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Role created successfully.',
                'data' => $role,
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
            $role = $this->roleService->update($id, $request->all());

            return response()->json([
                'success' => true,
                'message' => 'Role updated successfully.',
                'data' => $role,
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

            $this->roleService->destroy($id);

            return response()->json([
                'success' => true,
                'message' => 'Role deleted successfully.',
            ]);

        } catch (Throwable $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);

        }
    }
}