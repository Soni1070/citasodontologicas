@extends('layouts.admin')

@section('content')
<div class="row">
    <h1>Especialista {{ $dentista->nombres }} {{ $dentista->apellidos }}</h1>
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
                {{-- nombres --}}
                <div class="col-md-4">
                <div class="form-group mb-3">
                    <label for="name">Nombres</label>
                    <p>{{ $dentista->nombres }}</p>
                    @error ('nombres')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                </div>

                {{-- apellidos --}}
                <div class="col-md-4">
                <div class="form-group mb-3">
                    <label for="apellidos">Apellidos</label>
                    <p>{{ $dentista->apellidos }}</p>
                    @error ('apellidos')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                </div>

                {{-- registro medico --}}
                <div class="col-md-4">
                <div class="form-group mb-3">
                    <label for="registro_medico">Registro Médico</label>
                    <p>{{ $dentista->registro_medico }}</p>
                    @error ('registro_medico')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                </div>

                {{-- Especialidad --}}
                <div class="col-md-4">
                <div class="form-group mb-3">
                    <label for="especialidad">Especialidad</label>
                    <p>{{ $dentista->especialidad }}</p>
                    @error ('especialidad')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                </div>

                {{-- teléfono --}}
                <div class="col-md-4">
                <div class="form-group mb-3">
                    <label for="telefono">Teléfono</label>
                    <p>{{ $dentista->telefono }}</p>
                    @error ('telefono')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror   
                </div>
                </div>

                {{-- estado --}}
                <div class="col-md-4">
                <div class="form-group mb-3">
                    <label for="estado">Estado</label>
                    <p>{{ $dentista->estado }}</p>
                    @error ('estado')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                </div>

                {{-- Correo --}}
                <div class="col-md-4">
                <div class="form-group mb-3">
                    <label for="email">Correo electrónico</label>
                    <p>{{ $dentista->user->email }}</p>
                    @error ('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                </div>

        </div>  
               
                {{-- BOTONES --}}
                <div class="text-right mt-4">
                    <a href="{{ route('admin.dentistas.index') }}" class="btn btn-secondary">
                        Regresar
                    </a>
                 
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
