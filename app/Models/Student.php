<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Student extends BaseModel implements Auditable
{
    use HasFactory, SoftDeletes, AuditableTrait;

    protected $fillable = [
        'uuid',
        'user_id',
        'student_number',
        'full_name',
        'gender',
        'birth_date',
        'email',
        'phone',
        'address',
        'profile',
        'transcript_file',
        'is_active',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'profile' => 'array',
        'is_active' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
}