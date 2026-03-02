<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nombres',
        'apellidos',
        'documento',
        'numero_seguro',
        'fecha_nacimiento',
        'genero',
        'telefono',
        'correo',
        'direccion',
        'grupo_sanguineo',
        'alergias',
        'contacto_emergencia',
        'observaciones',
    ];

    public function historiaClinica()
{
    return $this->hasOne(HistoriaClinica::class);
}
}
