<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', 'path', 'name', 'type',
    ];

    // Relación con estudiante
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

}
