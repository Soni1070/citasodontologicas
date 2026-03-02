<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Dentista;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    
    public function index()
{
    return view('reportes.index');
}

    public function citas(Request $request)
{
    $query = Cita::with(['paciente', 'dentista', 'consultorio']);

    // Filtro por fechas
    if ($request->filled('fecha_inicio') && $request->filled('fecha_fin')) {
        $query->whereBetween('fecha_inicio', [
            $request->fecha_inicio . ' 00:00:00',
            $request->fecha_fin . ' 23:59:59'
        ]);
    }

    // Filtro por dentista
    if ($request->filled('dentista_id')) {
        $query->where('dentista_id', $request->dentista_id);
    }

    // Filtro por estado
    if ($request->filled('estado')) {
        $query->where('estado', $request->estado);
    }

    $citas = $query->orderBy('fecha_inicio', 'desc')->get();

    $totalCitas = $citas->count();
        $totalPendientes = (clone $query)->whereRaw("LOWER(estado) = 'pendiente'")->count();
        $totalConfirmadas = (clone $query)->whereRaw("LOWER(estado) = 'confirmada'")->count();
        $totalCanceladas = (clone $query)->whereRaw("LOWER(estado) = 'cancelada'")->count();
    $dentistas = Dentista::all();

    return view('reportes.citas', compact(
        'citas',
        'dentistas',
        'totalCitas',
        'totalPendientes',
        'totalConfirmadas',
        'totalCanceladas'
    ));
}

public function exportarExcel(Request $request)
{
    $query = Cita::with(['paciente', 'dentista', 'consultorio']);

    if ($request->filled('fecha_inicio') && $request->filled('fecha_fin')) {
        $query->whereBetween('fecha_inicio', [
            $request->fecha_inicio . ' 00:00:00',
            $request->fecha_fin . ' 23:59:59'
        ]);
    }

    if ($request->filled('dentista_id')) {
        $query->where('dentista_id', $request->dentista_id);
    }

    if ($request->filled('estado')) {
        $query->where('estado', $request->estado);
    }

    $citas = $query->orderBy('fecha_inicio', 'desc')->get();

    $filename = "reporte_citas.csv";

    $headers = [
        "Content-Type" => "text/csv",
        "Content-Disposition" => "attachment; filename=$filename",
    ];

    $callback = function() use ($citas) {
        $file = fopen('php://output', 'w');

        fputcsv($file, [
            'Paciente',
            'Dentista',
            'Consultorio',
            'Fecha Inicio',
            'Fecha Fin',
            'Estado'
        ]);

        foreach ($citas as $cita) {
            fputcsv($file, [
                $cita->paciente->nombres . ' ' . $cita->paciente->apellidos,
                $cita->dentista->nombres . ' ' . $cita->dentista->apellidos,
                $cita->consultorio->nombre ?? '',
                $cita->fecha_inicio,
                $cita->fecha_fin,
                $cita->estado
            ]);
        }

        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
}

public function productividad(Request $request)
{
    $productividad = Cita::select(
            'dentista_id',
            DB::raw('COUNT(*) as total'),
            DB::raw("SUM(CASE WHEN LOWER(estado) = 'pendiente' THEN 1 ELSE 0 END) as pendientes"),
            DB::raw("SUM(CASE WHEN LOWER(estado) = 'confirmada' THEN 1 ELSE 0 END) as confirmadas"),
            DB::raw("SUM(CASE WHEN LOWER(estado) = 'cancelada' THEN 1 ELSE 0 END) as canceladas")
        )
        ->with('dentista')
        ->groupBy('dentista_id')
        ->get();

    return view('reportes.productividad', compact('productividad'));
}

public function exportarProductividadExcel()
{
    $productividad = Cita::select(
            'dentista_id',
            DB::raw('COUNT(*) as total'),
            DB::raw("SUM(CASE WHEN LOWER(estado) = 'pendiente' THEN 1 ELSE 0 END) as pendientes"),
            DB::raw("SUM(CASE WHEN LOWER(estado) = 'confirmada' THEN 1 ELSE 0 END) as confirmadas"),
            DB::raw("SUM(CASE WHEN LOWER(estado) = 'cancelada' THEN 1 ELSE 0 END) as canceladas")
        )
        ->with('dentista')
        ->groupBy('dentista_id')
        ->get();

    $filename = "reporte_productividad.csv";

    $headers = [
        "Content-Type" => "text/csv",
        "Content-Disposition" => "attachment; filename=$filename",
    ];

    $callback = function() use ($productividad) {
        $file = fopen('php://output', 'w');

        fputcsv($file, [
            'Dentista',
            'Total Citas',
            'Pendientes',
            'Confirmadas',
            'Canceladas'
        ]);

        foreach ($productividad as $item) {
            fputcsv($file, [
                $item->dentista->nombres . ' ' . $item->dentista->apellidos,
                $item->total,
                $item->pendientes,
                $item->confirmadas,
                $item->canceladas
            ]);
        }

        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
}

}

