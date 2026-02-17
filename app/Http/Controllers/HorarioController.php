<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use Illuminate\Http\Request;
use App\Models\Dentista;
use App\Models\Consultorio;

class HorarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $consultorios = Consultorio::all();

    $query = Horario::with(['dentista', 'consultorio']);

    //filtro por consultorio
    if ($request->filled('consultorio_id')) {
        $query->where('consultorio_id', $request->consultorio_id);
    }

    $horarios = $query
        ->orderBy('dia')
        ->orderBy('hora_inicio')
        ->get();

    return view('admin.horarios.index', compact(
        'horarios',
        'consultorios'
    ));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dentistas = Dentista::where('estado', 'Activo')->get();
        $consultorios = Consultorio::where('estado', 'Activo')->get();

        return view('admin.horarios.create', compact('dentistas', 'consultorios'));
    }
    /**
     * Store a newly created resource in storage.
     */
 public function store(Request $request)
{
    $request->validate([
        'dia' => 'required|string|max:20',
        'hora_inicio' => 'required',
        'hora_fin' => 'required|after:hora_inicio',
        'dentista_id' => 'required|exists:dentistas,id',
        'consultorio_id' => 'required|exists:consultorios,id',
    ]);

    // Validar cruce de horarios
    $existe = Horario::where('consultorio_id', $request->consultorio_id)
        ->where('dia', $request->dia)
        ->where(function ($query) use ($request) {
            $query->where('hora_inicio', '<', $request->hora_fin)
            ->where('hora_fin', '>', $request->hora_inicio);
        })
        ->exists();

    if ($existe) {
        return back()
            ->withErrors([
                'hora_inicio' => 'Este consultorio ya tiene un horario asignado en ese rango'
            ])
            ->withInput();
    }

    Horario::create([
        'dia' => $request->dia,
        'hora_inicio' => $request->hora_inicio,
        'hora_fin' => $request->hora_fin,
        'dentista_id' => $request->dentista_id,
        'consultorio_id' => $request->consultorio_id,
    ]);

    return redirect()->route('admin.horarios.index')
        ->with('success', 'Horario creado exitosamente')
        ->with('icon', 'success');
}

    /**
     * Display the specified resource.
     */
    public function show(Horario $horario)
    {
        $horario->load(['dentista', 'consultorio']);

        return view('admin.horarios.show', compact('horario'));
    }

    
public function horariosPorConsultorio($consultorioId)
{
    $horarios = Horario::with('dentista')
        ->where('consultorio_id', $consultorioId)
        ->orderBy('dia')
        ->orderBy('hora_inicio')
        ->get();

    return response()->json($horarios);
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Horario $horario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Horario $horario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Horario $horario)
    {
        //
    }
}
