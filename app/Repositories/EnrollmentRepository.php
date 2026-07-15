<?php

namespace App\Repositories;

use OwenIt\Auditing\Models\Audit;
use App\Models\Enrollment;

class EnrollmentRepository extends BaseRepo
{
    public function __construct(Enrollment $model)
    {
        parent::__construct($model);
    }

    public function getAll()
    {
        return $this->model->with('student', 'major')->latest()->get();
    }

    public function find($id)
    {
        return $this->model->with('student', 'major')->where('id', $id)->first();
    }

    public function history($id)
    {
        $audits = Audit::join('users', 'users.id', 'audits.user_id')
            ->where('auditable_type', Enrollment::class)
            ->where('auditable_id', $id)
            ->orderByDesc('audits.created_at')
            ->get();

        $rows = [];

        foreach ($audits as $audit) {

            $oldValues = $audit->old_values ?? [];
            $newValues = $audit->new_values ?? [];

            $fields = array_unique(array_merge(
                array_keys($oldValues),
                array_keys($newValues)
            ));

            foreach ($fields as $field) {

                $rows[] = [
                    'created_at' => $audit->created_at->format('Y-m-d H:i:s'),
                    'event' => $audit->event,
                    'source' => 'Enrollment',
                    'name' => $audit->name,
                    'field' => ucwords(str_replace('_', ' ', $field)),
                    'old_value' => $oldValues[$field] ?? '-',
                    'new_value' => $newValues[$field] ?? '-',
                ];

            }

        }

        return $rows;
    }
}