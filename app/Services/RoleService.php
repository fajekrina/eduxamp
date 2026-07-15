<?php

namespace App\Services;

use App\Repositories\RoleRepository;
use Illuminate\Support\Facades\DB;

class RoleService
{
    protected $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function getAll()
    {
        return $this->roleRepository->getAll();
    }

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {

            return $this->roleRepository->create($data);

        });
    }

    public function find($id)
    {
        return DB::transaction(function () use ($id) {

            return $this->roleRepository->find($id);

        });
    }

    public function update($id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {

            return $this->roleRepository->update($id, $data);

        });
    }

    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {

            return $this->roleRepository->delete($id);

        });
    }
}