<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoriaClinica extends Model
{
    use HasFactory;

    protected $table = 'historias_clinicas';

    protected $fillable = [
        'paciente_id',
        'antecedentes_medicos',
        'enfermedades_sistemicas',
        'medicamentos_actuales',
        'antecedentes_odontologicos',
        'observaciones_generales',
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    public function seguimientos()
{
    return $this->hasMany(Seguimiento::class);
}
}
