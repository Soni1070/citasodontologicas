<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consultorio extends Model
{
    protected $fillable = [
        'nombre',
        'ubicacion',
        'capacidad',
        'telefono',
        'especialidad',
        'estado',
    ];

    public function dentistas()
    {
        return $this->hasMany(Dentista::class);
    }

    public function horarios()
    {
        return $this->hasMany(Horario::class);
    }

}
