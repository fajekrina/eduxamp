<?php

namespace App\Repositories;

use App\Models\Student;

class StudentRepository extends BaseRepo
{
    public function __construct(Student $model)
    {
        parent::__construct($model);
    }

    public function getLastStudent()
    {
        return $this->model->orderByDesc('id')->first();
    }
}