<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Secretaria extends Model
{
    
    protected $fillable = [
        'nombres',
        'apellidos',
        'documento',
        'direccion',
        'telefono',
        'fecha_nacimiento',
        'user_id',
    ];
    //
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
