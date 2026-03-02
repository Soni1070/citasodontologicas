<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Dentista;
use App\Models\Cita;
use Carbon\Carbon;


class DentistaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $dentistas = Dentista::with ('user')->get();
        return view('admin.dentistas.index', compact('dentistas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.dentistas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $datos = $request->validate([
        'nombres' => 'required|string|max:255',
        'apellidos' => 'required|string|max:255',
        'registro_medico' => 'required|string|max:50|unique:dentistas,registro_medico',
        'especialidad' => 'required|string|max:100',
        'telefono' => 'required|string|max:20',
        'estado' => 'nullable|string|max:50',
        'email' => 'required|email|max:255|unique:users,email',
        'password' => 'required|string|min:8|confirmed',
        
    ]);

    DB::transaction(function () use ($datos) {

        // Crear usuario
        $usuario = User::create([
            'name' => $datos['nombres'],
            'email' => $datos['email'],
            'password' => Hash::make($datos['password']),
        ]);

        // ASIGNAR ROL (dentista)
        $usuario->assignRole('dentista');

        // Crear dentista relacionado al usuario
        Dentista::create([
            'user_id' => $usuario->id,
            'nombres' => $datos['nombres'],
            'apellidos' => $datos['apellidos'],
            'registro_medico' => $datos['registro_medico'],
            'especialidad' => $datos['especialidad'],
            'telefono' => $datos['telefono'],
            'estado' => $datos['estado'] ?? 'Activo',

        ]);
    });

    return redirect()
        ->route('admin.dentistas.index')
        ->with('success', 'Dentista creado exitosamente.');
}


    /**
     * Display the specified resource.
     */
    public function show(Dentista $dentista)
    {
        $dentista = Dentista::with('user')->findOrFail($dentista->id);
        return view('admin.dentistas.show', compact('dentista'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dentista $dentista)
    {
        $dentista = Dentista::with('user')->findOrFail($dentista->id);
        return view('admin.dentistas.edit', compact('dentista'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dentista $dentista)
    {
        $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'registro_medico' => 'required|string|max:50|unique:dentistas,registro_medico,'.$dentista->id,
            'especialidad' => 'required|string|max:100',
            'telefono' => 'required|string|max:20',
            'estado' => 'nullable|string|max:50',
            'email' => 'required|email|max:255|unique:users,email,'.$dentista->user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $dentista->update([
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'registro_medico' => $request->registro_medico,
            'especialidad' => $request->especialidad,
            'telefono' => $request->telefono,
            'estado' => $request->estado,
        ]);

        $usuario = $dentista->user;
        $usuario->name = $request->nombres;
        $usuario->email = $request->email;

        if ($request->filled('password')) {
            $usuario->password = Hash::make($request->password);
        }
        $usuario->save();

        return redirect()->route('admin.dentistas.index')
        ->with('success', 'Dentista actualizado exitosamente.')
        ->with('icon', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dentista $dentista)
{
    DB::transaction(function () use ($dentista) {

        $usuario = $dentista->user;

        // Eliminar dentista
        $dentista->delete();

        // Eliminar usuario asociado
        if ($usuario) {
            $usuario->delete();
        }
    });

    return redirect()
        ->route('admin.dentistas.index')
        ->with('success', 'Dentista eliminado exitosamente.')
        ->with('icon', 'success');
}

public function dashboard()
{
    $dentista = Dentista::where('user_id', auth()->id())->firstOrFail();

    // Citas de HOY
    $citasHoy = Cita::with(['paciente', 'consultorio'])
        ->where('dentista_id', $dentista->id)
        ->whereDate('fecha_inicio', Carbon::today())
        ->orderBy('fecha_inicio')
        ->get();

    // Citas de ESTA SEMANA
    $citasSemana = Cita::with(['paciente', 'consultorio'])
        ->where('dentista_id', $dentista->id)
        ->whereBetween('fecha_inicio', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek()
        ])
        ->orderBy('fecha_inicio')
        ->get();

    return view('admin.dentistas.dashboard', compact(
        'dentista',
        'citasHoy',
        'citasSemana'
    ));
}

public function agenda(Request $request)
{
    // 1. Dentista logueado
    $dentista = Dentista::where('user_id', auth()->id())->firstOrFail();

    // 2. Vista solicitada (dia | semana | mes)
    $vista = $request->get('vista', 'dia'); // por defecto: HOY

    // 3. Query base
    $query = Cita::with(['paciente', 'consultorio'])
        ->where('dentista_id', $dentista->id);

    // 4. Filtros según botón
    if ($vista === 'dia') {
        $query->whereDate('fecha_inicio', Carbon::today());
    }

    if ($vista === 'semana') {
        $query->whereBetween('fecha_inicio', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek()
        ]);
    }

    if ($vista === 'mes') {
        $query->whereMonth('fecha_inicio', Carbon::now()->month)
              ->whereYear('fecha_inicio', Carbon::now()->year);
    }

    // 5. Obtener citas ordenadas
    $citas = $query->orderBy('fecha_inicio')->get();

    // 6. Enviar a la vista que YA EXISTE
    return view('agenda.dentista', compact('citas', 'vista'));
}


}
