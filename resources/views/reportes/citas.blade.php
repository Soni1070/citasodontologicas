@extends('layouts.admin')

@section('content')

<style>
@media print {
    .btn, form {
        display: none !important;
    }
}
</style>

<div class="card">
    <div class="card-header bg-primary text-white">
        <h4>Reporte de Citas</h4>
    </div>

    <div class="card-body">

        <!-- FILTROS -->
        <form method="GET" action="{{ route('reportes.citas') }}" class="row mb-4">

            <div class="col-md-3">
                <label>Fecha Inicio</label>
                <input type="date" name="fecha_inicio" class="form-control">
            </div>

            <div class="col-md-3">
                <label>Fecha Fin</label>
                <input type="date" name="fecha_fin" class="form-control">
            </div>

            <div class="col-md-3">
                <label>Dentista</label>
                <select name="dentista_id" class="form-control">
                    <option value="">Todos</option>
                    @foreach($dentistas as $dentista)
                        <option value="{{ $dentista->id }}">
                            {{ $dentista->nombres }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <label>Estado</label>
                <select name="estado" class="form-control">
                    <option value="">Todos</option>
                    <option value="Pendiente">Pendiente</option>
                    <option value="Confirmada">Confirmada</option>
                    <option value="Cancelada">Cancelada</option>
                </select>
            </div>

            <div class="col-md-12 mt-3">
                <button class="btn btn-primary">
                    Filtrar
                </button>
            </div>

        </form>

        <!-- TOTAL -->
        <div class="alert alert-info">
            Total de Citas: <strong>{{ $totalCitas }}</strong>
        </div>

        <div class="row mb-4">

    <div class="col-md-3">
        <div class="small-box bg-info">
            <div class="inner">
                <h4>{{ $totalCitas }}</h4>
                <p>Total Citas</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="small-box bg-warning">
            <div class="inner">
                <h4>{{ $totalPendientes }}</h4>
                <p>Pendientes</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="small-box bg-success">
            <div class="inner">
                <h4>{{ $totalConfirmadas }}</h4>
                <p>Confirmadas</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="small-box bg-danger">
            <div class="inner">
                <h4>{{ $totalCanceladas }}</h4>
                <p>Canceladas</p>
            </div>
        </div>
    </div>

</div>

<div class="mb-3">
    <a href="{{ route('reportes.citas.excel', request()->query()) }}" 
       class="btn btn-success">
        Exportar a Excel
    </a>

    <button onclick="window.print()" class="btn btn-danger">
        Exportar a PDF
    </button>
</div>

        <!-- TABLA -->
        <table class="table table-bordered table-striped">
            <thead class="bg-light">
                <tr>
                    <th>Paciente</th>
                    <th>Dentista</th>
                    <th>Consultorio</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @forelse($citas as $cita)
                    <tr>
                        <td>{{ $cita->paciente->nombres ?? '' }} {{ $cita->paciente->apellidos ?? '' }}</td> 
                        <td>{{ $cita->dentista->nombres ?? '' }} {{ $cita->dentista->apellidos ?? '' }}</td>
                        <td>{{ $cita->consultorio->nombre ?? '' }}</td>
                        <td>{{ $cita->fecha_inicio }}</td>
                        <td>{{ $cita->fecha_fin }}</td>
                        <td>{{ $cita->estado }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">
                            No hay registros
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</div>

@endsection