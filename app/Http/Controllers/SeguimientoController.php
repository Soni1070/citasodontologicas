<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SeguimientoController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'descripcion' => 'required|string',
        'cita_id' => 'required|exists:citas,id',
    ]);

    Seguimiento::create([
        'descripcion' => $request->descripcion,
        'cita_id' => $request->cita_id,
    ]);

    return redirect()->back()->with('success', 'Seguimiento guardado correctamente');
}
}
