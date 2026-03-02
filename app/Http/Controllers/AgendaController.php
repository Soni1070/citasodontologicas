<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\Dentista;
use App\Models\Cita;
use App\Models\Horario;
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

$citasModelos = $query->get(); // guardamos modelos completos

$citas = $citasModelos->map(function ($cita) {
    return [
        'id'    => $cita->id,
        'title' => $cita->paciente->nombres . ' ' . $cita->paciente->apellidos
                    . ' - ' . $cita->procedimiento,
        'start' => $cita->fecha_inicio,
        'end'   => $cita->fecha_fin,
        'color' => match($cita->estado) {
            'pendiente' => '#f59e0b',
            'confirmada' => '#3b82f6',
            'realizada' => '#10b981',
            'cancelada' => '#ef4444',
            'no_asistio' => '#6b7280',
            default => '#3788d8'
        },
        'extendedProps' => [
            'paciente_id'    => $cita->paciente_id,
            'dentista_id'    => $cita->dentista_id,
            'procedimiento'  => $cita->procedimiento,
            'estado'         => $cita->estado,
        ]
    ];
});

return view('admin.agenda.index', [
    'citas' => $citas, // para calendario
    'citasTabla' => $citasModelos, //  para modal tabla
    'pacientes' => Paciente::all(),
    'dentistas' => Dentista::all(),
]);
}

public function store(Request $request)
{
    $request->validate([
        'inicio' => 'required|date',
        'fin' => 'required|date|after:inicio',
        'paciente_id' => 'required|exists:pacientes,id',
        'dentista_id' => 'required|exists:dentistas,id',
        'procedimiento' => 'required|string|max:255',
    ]);

    $inicio = Carbon::parse($request->inicio);
    $fin = Carbon::parse($request->fin);
    $ahora = Carbon::now();

    // No fechas pasadas
    if ($inicio->lt(Carbon::today())) {
        return response()->json([
            'message' => 'No se pueden agendar citas en fechas pasadas'
        ], 422);
    }

    if ($inicio->isSameDay($ahora) && $inicio->lt($ahora)) {
        return response()->json([
            'message' => 'No se pueden agendar citas en horas que ya pasaron'
        ], 422);
    }

    //  Obtener día en español (ej: lunes)
    $dia = strtolower($inicio->locale('es')->dayName);

    //  Buscar horario válido
    $horario = Horario::where('dentista_id', $request->dentista_id)
        ->where('dia', $dia)
        ->where('hora_inicio', '<=', $inicio->format('H:i:s'))
        ->where('hora_fin', '>=', $fin->format('H:i:s'))
        ->first();

    if (!$horario) {
        return response()->json([
            'message' => 'El dentista no tiene horario disponible en ese día y hora'
        ], 422);
    }

    // Validar traslape
    $traslape = Cita::where('dentista_id', $request->dentista_id)
        ->whereDate('fecha_inicio', $inicio->format('Y-m-d'))
        ->where(function ($query) use ($inicio, $fin) {
            $query->where('fecha_inicio', '<', $fin)
                  ->where('fecha_fin', '>', $inicio);
        })
        ->exists();

    if ($traslape) {
        return response()->json([
            'message' => 'El dentista ya tiene una cita en ese horario'
        ], 422);
    }

    // Crear cita usando consultorio del horario
    $cita = Cita::create([
        'fecha_inicio'   => $inicio,
        'fecha_fin'      => $fin,
        'paciente_id'    => $request->paciente_id,
        'dentista_id'    => $request->dentista_id,
        'consultorio_id' => $horario->consultorio_id,
        'procedimiento'  => $request->procedimiento,
    ]);

    return response()->json([
        'id' => $cita->id,
        'title' => $cita->paciente->nombres . ' ' . $cita->paciente->apellidos
                    . ' - Dr. ' . $cita->dentista->nombres . ' ' . $cita->dentista->apellidos,
        'start' => $cita->fecha_inicio,
        'end' => $cita->fecha_fin,
        'extendedProps' => [
            'paciente_id' => $cita->paciente_id,
            'dentista_id' => $cita->dentista_id,
            'procedimiento' => $cita->procedimiento,
        ]
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

    $request->validate([
        'inicio' => 'required|date',
        'fin' => 'required|date|after:inicio',
        'paciente_id' => 'required|exists:pacientes,id',
        'dentista_id' => 'required|exists:dentistas,id',
        'procedimiento' => 'required|string|max:255',
        'estado' => 'required|string',
    ]);

    $inicio = Carbon::parse($request->inicio);
    $fin = Carbon::parse($request->fin);
    $ahora = Carbon::now();

    // No modificar fechas pasadas
    if ($inicio->lt(Carbon::today())) {
        return response()->json([
            'message' => 'No se pueden modificar citas en fechas pasadas'
        ], 422);
    }

    if ($inicio->isSameDay($ahora) && $inicio->lt($ahora)) {
        return response()->json([
            'message' => 'No se pueden modificar citas en horas que ya pasaron'
        ], 422);
    }

    // Obtener día
    $dia = strtolower($inicio->locale('es')->dayName);

    // Buscar horario válido
    $horario = Horario::where('dentista_id', $request->dentista_id)
        ->where('dia', $dia)
        ->where('hora_inicio', '<=', $inicio->format('H:i:s'))
        ->where('hora_fin', '>=', $fin->format('H:i:s'))
        ->first();

    if (!$horario) {
        return response()->json([
            'message' => 'El dentista no tiene horario disponible en ese día y hora'
        ], 422);
    }

    // Validar traslape (excluyendo esta cita)
    $traslape = Cita::where('dentista_id', $request->dentista_id)
        ->where('id', '!=', $id)
        ->whereDate('fecha_inicio', $inicio->format('Y-m-d'))
        ->where(function ($query) use ($inicio, $fin) {
            $query->where('fecha_inicio', '<', $fin)
                  ->where('fecha_fin', '>', $inicio);
        })
        ->exists();

    if ($traslape) {
        return response()->json([
            'message' => 'El dentista ya tiene una cita en ese horario'
        ], 422);
    }

    // Actualizar cita con consultorio correcto
    $cita->update([
        'fecha_inicio'   => $inicio,
        'fecha_fin'      => $fin,
        'paciente_id'    => $request->paciente_id,
        'dentista_id'    => $request->dentista_id,
        'consultorio_id' => $horario->consultorio_id,
        'procedimiento'  => $request->procedimiento,
        'estado'         => $request->estado,
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
            'procedimiento' => $cita->procedimiento,
            'estado' => $cita->estado,
        ]
    ]);
}

public function marcarRealizada($id)
{
    $cita = Cita::findOrFail($id);

    $cita->update([
        'estado' => 'realizada'
    ]);

    return back()->with('success', 'Cita marcada como realizada');
}

public function desmarcarRealizada($id)
{
    $cita = Cita::findOrFail($id);

    // Si tiene fecha futura, vuelve a pendiente
    if ($cita->fecha_inicio->isFuture()) {
        $nuevoEstado = 'pendiente';
    } else {
        $nuevoEstado = 'confirmada';
    }

    $cita->update([
        'estado' => $nuevoEstado
    ]);

    return back()->with('success', 'Estado revertido correctamente');
}

}