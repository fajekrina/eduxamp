<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\DB;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAll()
    {
        return $this->userRepository->getAll();
    }

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {

            return $this->userRepository->create($data);

        });
    }

    public function find($id)
    {
        return DB::transaction(function () use ($id) {

            return $this->userRepository->find($id);

        });
    }

    public function update($id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {

            return $this->userRepository->update($id, $data);

        });
    }

    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {

            return $this->userRepository->delete($id);

        });
    }
}