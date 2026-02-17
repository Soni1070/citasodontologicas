<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cita;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AgendaApiController extends Controller
{
    // LOGIN
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Credenciales incorrectas'
            ], 401);
        }

        return response()->json([
            'message' => 'Login exitoso',
            'user' => $user
        ]);
    }

    // VER AGENDA DEL DENTISTA
    public function agendaDentista($dentista_id)
    {
        $citas = Cita::where('dentista_id', $dentista_id)->get();

        return response()->json($citas);
    }

    // CREAR CITA
    public function store(Request $request)
{
    // VALIDACIONES
    $validated = $request->validate([
        'fecha_inicio' => 'required|date',
        'fecha_fin' => 'required|date|after:fecha_inicio',
        'paciente_id' => 'required|exists:pacientes,id',
        'dentista_id' => 'required|exists:dentistas,id',
        'consultorio_id' => 'required|exists:consultorios,id',
    ]);

    // CREAR CITA
    $cita = Cita::create($validated);

    return response()->json([
        'message' => 'Cita creada correctamente',
        'data' => $cita
    ], 201);
}

    // ACTUALIZAR CITA
    public function update(Request $request, $id)
{
    $cita = Cita::find($id);

    if (!$cita) {
        return response()->json([
            'message' => 'Cita no encontrada'
        ], 404);
    }

    $validated = $request->validate([
        'fecha_inicio' => 'required|date',
        'fecha_fin' => 'required|date|after:fecha_inicio',
        'paciente_id' => 'required|exists:pacientes,id',
        'dentista_id' => 'required|exists:dentistas,id',
        'consultorio_id' => 'required|exists:consultorios,id',
    ]);

    $cita->update($validated);

    return response()->json([
        'message' => 'Cita actualizada correctamente',
        'data' => $cita
    ]);
}

    // ELIMINAR CITA
    public function destroy($id)
    {
        $cita = Cita::find($id);

        if (!$cita) {
            return response()->json([
                'message' => 'Cita no encontrada'
            ], 404);
        }

        $cita->delete();

        return response()->json([
            'message' => 'Cita eliminada correctamente'
        ]);
    }
}


