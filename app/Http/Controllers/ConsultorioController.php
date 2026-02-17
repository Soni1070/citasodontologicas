<?php

namespace App\Http\Controllers;

use App\Models\Consultorio;
use Illuminate\Http\Request;

class ConsultorioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $consultorios = Consultorio::all();
        return view('admin.consultorios.index', compact('consultorios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.consultorios.create');   
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());

        request()->validate([
            'nombre' => 'required|string|max:255',
            'ubicacion' => 'required|string|max:255',
            'capacidad' => 'required|integer|min:1|max:3',
            'telefono' => 'required|string|max:20',
            'especialidad' => 'required|string|max:255',
            'estado' => 'required|string|max:50',
        ]);

        Consultorio::create($request->all());
        return redirect()->route('admin.consultorios.index')->with('success', 'Consultorio creado exitosamente.')->with('icon', 'success');

    }

    /**
     * Display the specified resource.
     */
    public function show(Consultorio $consultorio)
    {
        $consultorio = Consultorio::findorfail($consultorio->id);
        return view('admin.consultorios.show', compact('consultorio'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Consultorio $consultorio)
    {
        $consultorio = Consultorio::findorfail($consultorio->id);
        return view('admin.consultorios.edit', compact('consultorio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Consultorio $consultorio)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:255',
            'ubicacion' => 'required|string|max:255',
            'capacidad' => 'required|integer|min:1|max:3',
            'telefono' => 'required|string|max:20',
            'especialidad' => 'required|string|max:255',
            'estado' => 'required|string|max:50',
        ]);

        $consultorio = Consultorio::findOrFail($consultorio->id);
        $consultorio->update($datos);

        return redirect()->route('admin.consultorios.index')->with('success', 'Consultorio actualizado exitosamente.')->with('icon', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Consultorio $consultorio)
    {
        $consultorio = Consultorio::findOrFail($consultorio->id);
        $consultorio->delete();

        return redirect()->route('admin.consultorios.index')
            ->with('success', 'Consultorio eliminado exitosamente.')
            ->with('icon', 'success');
    }
}
