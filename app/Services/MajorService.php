<?php

namespace App\Services;

use App\Repositories\MajorRepository;
use Illuminate\Support\Facades\DB;

class MajorService
{
    protected $majorRepository;

    public function __construct(MajorRepository $majorRepository)
    {
        $this->majorRepository = $majorRepository;
    }

    public function getAll()
    {
        return $this->majorRepository->getAll();
    }

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {

            return $this->majorRepository->create($data);

        });
    }

    public function find($id)
    {
        return DB::transaction(function () use ($id) {

            return $this->majorRepository->find($id);

        });
    }

    public function update($id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {

            return $this->majorRepository->update($id, $data);

        });
    }

    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {

            return $this->majorRepository->delete($id);

        });
    }
}