<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dentista extends Model
{
    protected $fillable = [
    'user_id',
    'nombres',
    'apellidos',
    'registro_medico',
    'especialidad',
    'telefono',
    'estado',
];

    public function consultorios()
    {
        return $this->belongsTo(Consultorio::class);
    }

    public function horarios()
    {
        return $this->hasMany(Horario::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
