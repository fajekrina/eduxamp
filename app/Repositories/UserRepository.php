<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepo
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function getAll()
    {
        return $this->model
            ->with('role')
            ->latest()
            ->get();
    }

    public function find($id)
    {
        return $this->model->with('role')->where('id', $id)->first();
    }

    public function create($data)
    {
        $data['password'] = Hash::make($data['password']);

        return $this->model->create($data);
    }
}