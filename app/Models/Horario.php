<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $fillable = [
    'dia',
    'hora_inicio',
    'hora_fin',
    'dentista_id',
    'consultorio_id',
];


    public function dentista()
    {
        return $this->belongsTo(Dentista::class);
    }

    public function consultorio()
    {
        return $this->belongsTo(Consultorio::class);
    }
}
