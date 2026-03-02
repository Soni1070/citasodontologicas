<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    protected $table = 'citas'; // SE FORZA LA TABLA
    protected $fillable = [
    'fecha_inicio',
    'fecha_fin',
    'paciente_id',
    'dentista_id',
    'consultorio_id',
    'procedimiento',
    'estado', 
];

    protected $casts = [
    'fecha_inicio' => 'datetime',
    'fecha_fin' => 'datetime',
];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    public function dentista()
    {
        return $this->belongsTo(Dentista::class);
    }

    public function consultorio()
    {
        return $this->belongsTo(Consultorio::class);
    }

    public function seguimientos()
    {
    return $this->hasMany(Seguimiento::class);
    }
}
