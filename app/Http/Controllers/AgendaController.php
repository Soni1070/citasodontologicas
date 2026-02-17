<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\Dentista;
use App\Models\Consultorio;
use App\Models\Cita;
use Carbon\Carbon;

class AgendaController extends Controller
{

public function index()
{
    $user = Auth::user();

    // DENTISTA: vista solo lectura (tabla)
    if ($user->hasRole('dentista')) {

        $citas = Cita::with(['paciente', 'consultorio'])
            ->where('dentista_id', $user->dentista->id)
            ->orderBy('fecha_inicio')
            ->get();

        return view('agenda.dentista', compact('citas'));
    }

    // ADMIN y SECRETARIA: FullCalendar
    $query = Cita::with(['paciente', 'dentista', 'consultorio']);

    $citas = $query->get()->map(function ($cita) {
        return [
            'id'    => $cita->id,
            'title' => $cita->paciente->nombres . ' ' . $cita->paciente->apellidos
                        . ' - ' . $cita->procedimiento,
            'start' => $cita->fecha_inicio,
            'end'   => $cita->fecha_fin,
            'extendedProps' => [
                'paciente_id'    => $cita->paciente_id,
                'dentista_id'    => $cita->dentista_id,
                'consultorio_id' => $cita->consultorio_id,
                'procedimiento'  => $cita->procedimiento,
            ]
        ];
    });

    return view('admin.agenda.index', [
        'citas' => $citas,
        'pacientes' => Paciente::all(),
        'dentistas' => Dentista::all(),
        'consultorios' => Consultorio::all(),
    ]);
}

public function store(Request $request)
{
    $request->validate([
        'inicio' => 'required|date',
        'fin' => 'required|date|after:inicio',
        'paciente_id' => 'required|exists:pacientes,id',
        'dentista_id' => 'required|exists:dentistas,id',
        'consultorio_id' => 'required|exists:consultorios,id',
        'procedimiento' => 'required|string|max:255',
    ]);

    // NO fechas pasadas
    $inicio = Carbon::parse($request->inicio);
    if ($inicio->isPast()) {
        return response()->json([
            'message' => 'No se pueden agendar citas en fechas pasadas'
        ], 422);
    }

    // VALIDACIÓN DE TRASLAPE
    $traslape = Cita::where('dentista_id', $request->dentista_id)
    ->whereDate('fecha_inicio', date('Y-m-d', strtotime($request->inicio)))
    ->where(function ($query) use ($request) {
        $query
            ->where('fecha_inicio', '<', $request->fin)
            ->where('fecha_fin', '>', $request->inicio);
    })
    ->exists();

    if ($traslape) {
        return response()->json([
            'message' => 'El dentista ya tiene una cita en ese horario'
        ], 422);
    }

    // CREAR CITA
    $cita = Cita::create([
        'fecha_inicio'   => $request->inicio,
        'fecha_fin'      => $request->fin,
        'paciente_id'    => $request->paciente_id,
        'dentista_id'    => $request->dentista_id,
        'consultorio_id' => $request->consultorio_id,
        'procedimiento'  => $request->procedimiento,
    ]);

        return response()->json([
    'id'    => $cita->id,
    'title' => $cita->paciente->nombres . ' ' . $cita->paciente->apellidos
                . ' - Dr. ' . $cita->dentista->nombres,
    'start' => $cita->fecha_inicio,
    'end'   => $cita->fecha_fin,
    ]);
}

public function destroy($id)
{
    $cita = Cita::findOrFail($id);
    $cita->delete();

    return response()->json(['message' => 'Cita eliminada']);
}

public function update(Request $request, $id)
{
    $cita = Cita::findOrFail($id);

    // NO editar citas pasadas
    $inicio = Carbon::parse($request->inicio);
    if ($inicio->isPast()) {
        return response()->json([
            'message' => 'No se pueden modificar citas en fechas pasadas'
        ], 422);
    }

    // reutilizamos la MISMA validación de traslape
    // (excluyendo la cita actual)
    $traslape = Cita::where('dentista_id', $request->dentista_id)
        ->where('id', '!=', $id)
        ->where('fecha_inicio', '<', $request->fin)
        ->where('fecha_fin', '>', $request->inicio)
        ->exists();

    if ($traslape) {
        return response()->json(['message' => 'Horario ocupado'], 422);
    }

    $cita->update([
        'fecha_inicio' => $request->inicio,
        'fecha_fin' => $request->fin,
        'paciente_id' => $request->paciente_id,
        'dentista_id' => $request->dentista_id,
        'consultorio_id' => $request->consultorio_id,
        'procedimiento' => $request->procedimiento,
    ]);

    return response()->json([
    'id' => $cita->id,
    'title' => $cita->paciente->nombres . ' ' . $cita->paciente->apellidos
                . ' - Dr. ' . $cita->dentista->nombres,
    'start' => $cita->fecha_inicio,
    'end' => $cita->fecha_fin,
    'extendedProps' => [
        'paciente_id' => $cita->paciente_id,
        'dentista_id' => $cita->dentista_id,
        'consultorio_id' => $cita->consultorio_id,
        'procedimiento' => $cita->procedimiento,
    ]
    ]);
}

}