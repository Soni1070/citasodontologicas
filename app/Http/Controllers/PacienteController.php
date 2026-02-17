<?php

namespace App\Http\Controllers;

use App\Models\paciente;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pacientes = Paciente::all();
        return view('admin.pacientes.index', compact('pacientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pacientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$datos = request()->all();
        //return response()->json($datos);
        $datos = request()->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'documento' => 'required|string|max:50|unique:pacientes,documento',
            'numero_seguro' => 'required|string|max:50|unique:pacientes,numero_seguro',
            'fecha_nacimiento' => 'required|date',
            'genero' => 'required|string|in:Masculino,Femenino',
            'telefono' => 'required|string|max:20',
            'correo' => 'required|email|max:255|unique:pacientes,correo',
            'direccion' => 'required|string|max:255',
            'grupo_sanguineo' => 'required|string|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'alergias' => 'nullable|string',
            'contacto_emergencia' => 'nullable|string|max:255',
            'observaciones' => 'nullable|string',
        ]);

        $paciente = new Paciente();
        $paciente->nombres = $datos['nombres'];
        $paciente->apellidos = $datos['apellidos'];
        $paciente->documento = $datos['documento'];
        $paciente->numero_seguro = $datos['numero_seguro'];
        $paciente->fecha_nacimiento = $datos['fecha_nacimiento'];   
        $paciente->genero = $datos['genero'];
        $paciente->telefono = $datos['telefono'];
        $paciente->correo = $datos['correo'];
        $paciente->direccion = $datos['direccion'];
        $paciente->grupo_sanguineo = $datos['grupo_sanguineo'];
        $paciente->alergias = $datos['alergias'] ?? null;
        $paciente->contacto_emergencia = $datos['contacto_emergencia'] ?? null;
        $paciente->observaciones = $datos['observaciones'] ?? null;
        $paciente->save();

        //  ASIGNAR ROL (paciente)
        $usuario->assignRole('paciente');

        return redirect()->route('admin.pacientes.index')
        ->with('success', 'Paciente creado exitosamente.')
        ->with('icon', 'success');


    }

    /**
     * Display the specified resource.
     */
    public function show(paciente $paciente)
    {
        $paciente = Paciente::findOrFail($paciente->id);
        return view('admin.pacientes.show', compact('paciente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(paciente $paciente)
    {
        $paciente = Paciente::findOrFail($paciente->id);
        return view('admin.pacientes.edit', compact('paciente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Paciente $paciente)
{
    $datos = $request->validate([
        'nombres' => 'required|string|max:255',
        'apellidos' => 'required|string|max:255',
        'documento' => 'required|string|max:50|unique:pacientes,documento,' . $paciente->id,
        'numero_seguro' => 'required|string|max:50|unique:pacientes,numero_seguro,' . $paciente->id,
        'fecha_nacimiento' => 'required|date',
        'genero' => 'required|string|in:Masculino,Femenino',
        'telefono' => 'required|string|max:20',
        'correo' => 'required|email|max:255|unique:pacientes,correo,' . $paciente->id,
        'direccion' => 'required|string|max:255',
        'grupo_sanguineo' => 'required|string|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
        'alergias' => 'nullable|string',
        'contacto_emergencia' => 'nullable|string|max:255',
        'observaciones' => 'nullable|string',
    ]);

    $paciente->update($datos);

    return redirect()->route('admin.pacientes.index')
        ->with('success', 'Paciente actualizado exitosamente.')
        ->with('icon', 'success');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(paciente $paciente)
    {
        $paciente->delete();

   return redirect()->route('admin.pacientes.index')
        ->with('success', 'Paciente eliminado correctamente.')
        ->with('icon', 'success');
    }
}
