@extends('layouts.admin')

@section('content')
<div class="row">
    <h1>Modificar datos del paciente: {{ $paciente->nombres }} {{ $paciente->apellidos }}</h1>
</div>

<hr>

<div class="row justify-content-center">
    <div class="col-md-12">

        <div class="card card-outline card-warning" style="max-width: 1000px; margin: auto;">
            <div class="card-header text-center">
                <h3 class="card-title">Diligencie los datos</h3>
            </div>

            <div class="card-body">
            <form action="{{ route('admin.pacientes.update', $paciente->id) }}" method="POST">
                @csrf
                @method('PUT')

        <div class="row">
                <div class="col-md-4">
                {{-- Nombre --}}
                <div class="form-group mb-3">
                    <label for="name">Nombres</label> <b>*</b>
                    <input type="text" value="{{ old('nombres', $paciente->nombres) }}" class="form-control" id="name" name="nombres" required>
                    @error ('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                </div>

                <div class="col-md-4">
                {{-- Apellido --}}
                <div class="form-group mb-3">
                    <label for="apellido">Apellidos</label> <b>*</b>
                    <input type="text" value="{{ old('apellidos', $paciente->apellidos) }}" class="form-control" id="apellido" name="apellidos" required>
                    @error ('apellidos')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                </div>

                <div class="col-md-4">
                {{-- Documento --}}
                <div class="form-group mb-3">
                    <label for="documento">Documento</label> <b>*</b>
                    <input type="text" value="{{ old('documento', $paciente->documento) }}" class="form-control" id="documento" name="documento" required>
                    @error ('documento')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                </div>

            <div class="row">
                <div class="col-md-4">
                {{-- Numero_seguro --}}
                <div class="form-group mb-3">
                    <label for="numero_seguro">Número de seguro</label> <b>*</b>
                    <input type="text" value="{{ old('numero_seguro', $paciente->numero_seguro) }}" class="form-control" id="numero_seguro" name="numero_seguro" required>
                    @error ('numero_seguro')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                </div>

                <div class="col-md-4">
                {{-- Fecha_Nacimiento --}}
                <div class="form-group mb-3">
                    <label for="fecha_nacimiento">Fecha de nacimiento</label> <b>*</b>
                    <input type="date" value="{{ old('fecha_nacimiento', $paciente->fecha_nacimiento) }}" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
                    @error ('fecha_nacimiento')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                </div>

                <div class="col-md-4">
                {{-- Genero --}}
                <div class="form-group mb-3">
                    <label for="genero">Género</label> <b>*</b>
                    <select class="form-control" id="genero" name="genero" required">
                        <option value="" disabled>Seleccione género</option>
                        <option value="Masculino" {{ old('genero', $paciente->genero) == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                        <option value="Femenino" {{ old('genero', $paciente->genero) == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                    </select>
                    @error ('genero')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                </div>

                <div class="col-md-4">
                {{-- Telefono --}}
                <div class="form-group mb-3">
                    <label for="telefono">Teléfono</label> <b>*</b>
                    <input type="number" value="{{ old('telefono', $paciente->telefono) }}" class="form-control" id="telefono" name="telefono" required>
                    @error ('telefono')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                </div>

            <div class="col-md-4">
                {{-- Correo --}}
                <div class="form-group mb-3">
                    <label for="email">Correo electrónico</label> <b>*</b>
                    <input type="email" value="{{ old('correo', $paciente->correo) }}" class="form-control" id="email" name="correo" required>
                    @error ('correo')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                </div>

                <div class="col-md-4">
                {{-- Direccion --}}
                <div class="form-group mb-3">
                    <label for="direccion">Dirección</label> <b>*</b>
                    <input type="text" value="{{ old('direccion', $paciente->direccion) }}" class="form-control" id="direccion" name="direccion" required>
                    @error ('direccion')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                </div>

                <div class="col-md-4">
                {{-- Grupo_Sanguineo --}}
                <div class="form-group mb-3">
                    <label for="grupo_sanguineo">Grupo sanguíneo</label> <b>*</b>
                    <select class="form-control" id=grupo_sanguineo name=grupo_sanguineo required>
                       <option value="" disabled>Seleccione grupo sanguíneo</option>
                       <option value=A+ {{ old('grupo_sanguineo', $paciente->grupo_sanguineo) == 'A+' ? 'selected' : '' }}>A+</option>
                          <option value=A- {{ old('grupo_sanguineo', $paciente->grupo_sanguineo) == 'A-' ? 'selected' : '' }}>A-</option>
                            <option value=B+ {{ old('grupo_sanguineo', $paciente->grupo_sanguineo) == 'B+' ? 'selected' : '' }}>B+</option>
                              <option value=B- {{ old('grupo_sanguineo', $paciente->grupo_sanguineo) == 'B-' ? 'selected' : '' }}>B-</option>
                                <option value=AB+ {{ old('grupo_sanguineo', $paciente->grupo_sanguineo) == 'AB+' ? 'selected' : '' }}>AB+</option>
                                  <option value=AB- {{ old('grupo_sanguineo', $paciente->grupo_sanguineo) == 'AB-' ? 'selected' : '' }}>AB-</option>
                                    <option value=O+ {{ old('grupo_sanguineo', $paciente->grupo_sanguineo) == 'O+' ? 'selected' : '' }}>O+</option>
                                      <option value=O->O-</option>
                      </select>
                      @error ('grupo_sanguineo')
                          <small class=\"text-danger\">{{ $message }}</small>
                      @enderror
                  </div>
                    </div>

                    <div class="col-md-4">
                  {{-- Alergias --}}
                  <div class="form-group mb-3">
                    <label for="alergias">Alergias</label>
                    <textarea
                    class="form-control"
                    id="alergias"
                    name="alergias"
                    rows="4"
                    placeholder="Ej: Penicilina, Manzana, Látex..."
                    >{{ old('alergias', $paciente->alergias) }}</textarea>
                    @error('alergias')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                </div>

                <div class="col-md-4">
                  {{-- Contacto_emergencia --}}
                  <div class="form-group mb-3">
                      <label for="contacto_emergencia">Contacto de emergencia</label>
                      <input type="text" value="{{ old('contacto_emergencia', $paciente->contacto_emergencia) }}" class="form-control" id="contacto_emergencia" name="contacto_emergencia">
                      @error ('contacto_emergencia')
                          <small class="text-danger">{{ $message }}</small>
                      @enderror
                  </div>
                    </div>

                   <div class="col-md-12">
                  {{-- Observaciones --}}
                    <div class="form-group mb-3">
                    <label for="observaciones">Observaciones</label>
                    <textarea
                    class="form-control"
                    id="observaciones"
                    name="observaciones"
                    rows="4"
                    placeholder="Observaciones adicionales del paciente..."
                    >{{ old('observaciones', $paciente->observaciones) }}</textarea>
                    @error('observaciones')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                    </div>
                    </div>
            </div>
                           
                {{-- BOTONES --}}
                <div class="text-right mt-4">
                    <a href="{{ route('admin.pacientes.index') }}" class="btn btn-secondary">
                        Cancelar
                    </a>

                    <button type="submit" class="btn btn-warning">
                        Actualizar paciente
                    </button>
                 
                </div>
            </form>
            </div>
        </div>

    </div>
</div>
@endsection
