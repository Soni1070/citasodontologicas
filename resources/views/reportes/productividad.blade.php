@extends('layouts.admin')

@section('content')

<style>
@media print {
    .btn {
        display: none !important;
    }
}
</style>

<div class="mb-3">
    <a href="{{ route('reportes.productividad.excel') }}" 
       class="btn btn-success">
        Exportar a Excel
    </a>

    <button onclick="window.print()" 
            class="btn btn-danger">
        Exportar a PDF
    </button>
</div>

<div class="card">
    <div class="card-header bg-primary text-white">
        <h4>Reporte de Productividad por Dentista</h4>
    </div>

    <div class="card-body">

        <table class="table table-bordered table-striped">
            <thead class="bg-light">
                <tr>
                    <th>Dentista</th>
                    <th>Total Citas</th>
                    <th>Pendientes</th>
                    <th>Confirmadas</th>
                    <th>Canceladas</th>
                </tr>
            </thead>
            <tbody>
                @foreach($productividad as $item)
                    <tr>
                        <td>
                            {{ $item->dentista->nombres ?? '' }}
                            {{ $item->dentista->apellidos ?? '' }}
                        </td>
                        <td>{{ $item->total }}</td>
                        <td>{{ $item->pendientes }}</td>
                        <td>{{ $item->confirmadas }}</td>
                        <td>{{ $item->canceladas }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

@endsection