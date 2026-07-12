<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Enrollment extends BaseModel implements Auditable
{
    use HasFactory, SoftDeletes, AuditableTrait;

    protected $fillable = [
        'uuid',
        'student_id',
        'major_id',
        'enrollment_number',
        'enrollment_date',
        'status',
        'attachment',
        'remarks',
        'student_number_snapshot',
        'student_name_snapshot',
        'major_code_snapshot',
        'major_name_snapshot',
        'is_active',
    ];

    protected $casts = [
        'enrollment_date' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function major()
    {
        return $this->belongsTo(Major::class);
    }
}