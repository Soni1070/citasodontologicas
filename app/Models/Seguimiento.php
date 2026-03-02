<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seguimiento extends Model
{
    use HasFactory;

    protected $fillable = [
        'historia_clinica_id',
        'cita_id',
        'diagnostico',
        'tratamiento',
        'observaciones',
        'descripcion',
    ];

    public function historiaClinica()
    {
        return $this->belongsTo(HistoriaClinica::class);
    }

    public function cita()
    {
        return $this->belongsTo(Cita::class);
    }
}
