@extends('layouts.admin')

@section('content')
<div class="row">
    <h1>{{ $consultorio->nombre }}</h1>
</div>

<hr>

<div class="row justify-content-center">
    <div class="col-md-12">

        <div class="card card-outline card-info" style="max-width: 1000px; margin: auto;">
            <div class="card-header text-center">
                <h3 class="card-title">Datos registrados</h3>
            </div>

            <div class="card-body">

        <div class="row">
                <div class="col-md-4">
                {{-- Consultorio --}}
                <div class="form-group mb-3">
                    <label for="nombre">Nombre del consultorio</label>
                    <p>{{ $consultorio->nombre }}</p>
                </div>
                </div>

                <div class="col-md-4">
                {{-- Ubicacion --}}
                <div class="form-group mb-3">
                    <label for="ubicacion">Ubicacion</label>
                    <p>{{ $consultorio->ubicacion }}</p>
                </div>
                </div>

                <div class="col-md-4">
                {{-- Capacidad --}}
                <div class="form-group mb-3">
                    <label for="capacidad">Capacidad</label>
                    <p>{{ $consultorio->capacidad }} persona(s)</p>
                </div>
                </div>

                <div class="col-md-4">
                {{-- Telefono --}}
                <div class="form-group mb-3">
                    <label for="telefono">Telefono</label>
                    <p>{{ $consultorio->telefono }}</p>
                </div>
                </div>

                <div class="col-md-4">
                {{-- Especialidad --}}
                <div class="form-group mb-3">
                    <label for="especialidad">Especialidad</label>
                    <p>{{ $consultorio->especialidad }}</p>
                </div>
                </div>

                <div class="col-md-4">
                {{-- Estado --}}
                <div class="form-group mb-3">
                    <label for="estado">Estado</label>
                    <p>{{ $consultorio->estado }}</p>
                </div>
                </div>

        </div>
                           
                {{-- BOTONES --}}
                <div class="text-right mt-4">
                    <a href="{{ route('admin.consultorios.index') }}" class="btn btn-secondary">
                        Regresar
                    </a>

                 
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
