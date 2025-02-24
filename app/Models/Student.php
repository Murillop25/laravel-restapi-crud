<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'student';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'language',
        'user_id', // Asegúrate de agregar 'user_id' a los campos rellenables
    ];

    /**
     * Relación de "pertenece a" con el modelo User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}