@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <h2>Módulo de Reportes</h2>
        <hr>

        <a href="{{ route('reportes.citas') }}" class="btn btn-primary">
            Reporte de Citas
        </a>

        <a href="{{ route('reportes.productividad') }}" class="btn btn-success">
            Reporte de Productividad
        </a>
    </div>
</div>
@endsection