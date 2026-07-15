<?php

namespace App\Repositories;

use App\Models\Major;

class MajorRepository extends BaseRepo
{
    public function __construct(Major $model)
    {
        parent::__construct($model);
    }
}