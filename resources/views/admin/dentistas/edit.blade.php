@extends('layouts.admin')

@section('content')
<div class="row">
    <h1>Especialista {{ $dentista->nombres }} {{ $dentista->apellidos }}</h1>
</div>

<hr>

<div class="row justify-content-center">
    <div class="col-md-12">

        <div class="card card-outline card-success" style="max-width: 1000px; margin: auto;">
            <div class="card-header text-center">
                <h3 class="card-title">Actualizar datos</h3>
            </div>

            <div class="card-body">
            <form action="{{ route('admin.dentistas.update', $dentista->id) }}" method="POST">
                @csrf
                @method('PUT')
        <div class="row">
                {{-- nombres --}}
                <div class="col-md-4">
                <div class="form-group mb-3">
                    <label for="name">Nombres</label> <b>*</b>
                    <input type="text" value="{{ old('name', $dentista->nombres) }}" class="form-control" id="name" name="nombres" required>
                    @error ('nombres')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                </div>

                {{-- apellidos --}}
                <div class="col-md-4">
                <div class="form-group mb-3">
                    <label for="apellidos">Apellidos</label> <b>*</b>
                    <input type="text" value="{{ old('apellidos', $dentista->apellidos) }}" class="form-control" id="apellidos" name="apellidos" required>
                    @error ('apellidos')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                </div>

                {{-- registro medico --}}
                <div class="col-md-4">
                <div class="form-group mb-3">
                    <label for="registro_medico">Registro Médico</label> <b>*</b>
                    <input type="text" value="{{ old('registro_medico', $dentista->registro_medico) }}" class="form-control" id="registro_medico" name="registro_medico" required>
                    @error ('registro_medico')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                </div>

                {{-- Especialidad --}}
                <div class="col-md-4">
                <div class="form-group mb-3">
                    <label for="especialidad">Especialidad</label> <b>*</b>
                    <select class="form-control" id="especialidad" name="especialidad" required>
                        <option value="" disabled selected>Seleccione especialidad</option>
                        <option value="Odontología General" {{ old('especialidad', $dentista->especialidad) == 'Odontología General' ? 'selected' : '' }}>Odontología General</option>
                        <option value="Endodoncia" {{ old('especialidad', $dentista->especialidad) == 'Endodoncia' ? 'selected' : '' }}>Endodoncia</option>
                        <option value="Ortodoncia" {{ old('especialidad', $dentista->especialidad) == 'Ortodoncia' ? 'selected' : '' }}>Ortodoncia</option>
                        <option value="Periodoncia" {{ old('especialidad', $dentista->especialidad) == 'Periodoncia' ? 'selected' : '' }}>Periodoncia</option>
                        <option value="Cirugía Oral" {{ old('especialidad', $dentista->especialidad) == 'Cirugía Oral' ? 'selected' : '' }}>Cirugía Oral</option>
                        <option value="Prostodoncia" {{ old('especialidad', $dentista->especialidad) == 'Prostodoncia' ? 'selected' : '' }}>Prostodoncia</option>
                        <option value="Odontopediatría" {{ old('especialidad', $dentista->especialidad) == 'Odontopediatría' ? 'selected' : '' }}>Odontopediatría</option>
                    </select>
                    @error ('especialidad')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                </div>

                {{-- teléfono --}}
                <div class="col-md-4">
                <div class="form-group mb-3">
                    <label for="telefono">Teléfono</label> <b>*</b>
                    <input type="number" value="{{ old('telefono', $dentista->telefono) }}" class="form-control" id="telefono" name="telefono" required>
                    @error ('telefono')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror   
                </div>
                </div>

                {{-- estado --}}
                <div class="col-md-4">
                <div class="form-group mb-3">
                    <label for="estado">Estado</label> <b>*</b>
                    <select name="estado" id="estado" class="form-control" required>
                        <option value="" disabled selected>Seleccione un estado</option>
                        <option value="activo" {{ old('estado', $dentista->estado) == 'activo' ? 'selected' : '' }}>Activo</option>
                        <option value="inactivo" {{ old('estado', $dentista->estado) == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                    @error ('estado')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                </div>

                {{-- Correo --}}
                <div class="col-md-4">
                <div class="form-group mb-3">
                    <label for="email">Correo electrónico</label> <b>*</b>
                    <input type="email" value="{{ old('email', $dentista->user->email) }}" class="form-control" id="email" name="email" required>
                    @error ('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                </div>

                {{-- Contraseña --}}
                <div class="col-md-4">
                <div class="form-group mb-3">
                    <label for="password">Contraseña</label> <b>*</b>
                    <input type="password" class="form-control" id="password" name="password" required>
                    @error ('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                </div>

                {{-- Confirmación --}}
                <div class="col-md-4">
                <div class="form-group mb-3">
                    <label for="password_confirmation">Confirmar contraseña</label> <b>*</b>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                    @error ('password_confirmation')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                </div>
        </div>  
               
                {{-- BOTONES --}}
                <div class="text-right mt-4">
                    <a href="{{ route('admin.dentistas.index') }}" class="btn btn-secondary">
                        Cancelar
                    </a>

                    <button type="submit" class="btn btn-success">
                        Actualizar Especialista
                    </button>
                 
                </div>
            </form>
            </div>
        </div>

    </div>
</div>
@endsection
