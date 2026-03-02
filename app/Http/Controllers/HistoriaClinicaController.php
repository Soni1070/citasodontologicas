<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\HistoriaClinica;
use App\Models\Cita;
use Illuminate\Http\Request;

class HistoriaClinicaController extends Controller
{
     public function __construct()
    {
        $this->middleware('role:admin|secretaria|dentista');
    }

    public function show($paciente_id)
    {
        $paciente = Paciente::findOrFail($paciente_id);

        // Buscar historia clínica o crearla automáticamente
        $historia = HistoriaClinica::firstOrCreate(
            ['paciente_id' => $paciente->id],
            [
                'antecedentes_medicos' => null,
                'enfermedades_sistemicas' => null,
                'medicamentos_actuales' => null,
                'antecedentes_odontologicos' => null,
                'observaciones_generales' => null,
            ]
        );

        $citas = Cita::with(['seguimientos.cita.dentista'])
        ->where('paciente_id', $paciente->id)
        ->orderBy('fecha_inicio', 'desc')
        ->get();

        return view('historias.show', compact('paciente', 'historia', 'citas'));
    }

    public function update(Request $request, $id)
    {
        $historia = HistoriaClinica::findOrFail($id);

        $request->validate([
            'antecedentes_medicos' => 'nullable|string',
            'enfermedades_sistemicas' => 'nullable|string',
            'medicamentos_actuales' => 'nullable|string',
            'antecedentes_odontologicos' => 'nullable|string',
            'observaciones_generales' => 'nullable|string',
        ]);

        $historia->update($request->all());

        return redirect()->back()->with('success', 'Historia clínica actualizada correctamente');
    }
}
