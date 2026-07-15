<?php

namespace App\Repositories;

use App\Models\Role;

class RoleRepository extends BaseRepo
{
    public function __construct(Role $model)
    {
        parent::__construct($model);
    }
}