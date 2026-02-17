@extends('layouts.admin')

@section('content')
<div class="row">
    <h1>Paciente: {{ $paciente->nombres }} {{ $paciente->apellidos }}</h1>
</div>

<hr>

<div class="row justify-content-center">
    <div class="col-md-12">

        <div class="card card-outline card-primary" style="max-width: 1000px; margin: auto;">
            <div class="card-header text-center">
                <h3 class="card-title">Datos del paciente</h3>
            </div>

            <div class="card-body">

        <div class="row">
                <div class="col-md-4">
                {{-- Nombre --}}
                <div class="form-group mb-3">
                    <label for="name">Nombres</label>
                    <p>{{ $paciente->nombres }}</p>
                </div>
                </div>

                <div class="col-md-4">
                {{-- Apellido --}}
                <div class="form-group mb-3">
                    <label for="apellido">Apellidos</label>
                    <p >{{ $paciente->apellidos }}</p>
                </div>
                </div>

                <div class="col-md-4">
                {{-- Documento --}}
                <div class="form-group mb-3">
                    <label for="documento">Documento</label>
                    <p >{{ $paciente->documento }}</p>
                </div>
                </div>

            <div class="row">
                <div class="col-md-4">
                {{-- Numero_seguro --}}
                <div class="form-group mb-3">
                    <label for="numero_seguro">Número de seguro</label> <b>*</b>
                    <p >{{ $paciente->numero_seguro }}</p>
                </div>
                </div>

                <div class="col-md-4">
                {{-- Fecha_Nacimiento --}}
                <div class="form-group mb-3">
                    <label for="fecha_nacimiento">Fecha de nacimiento</label> <b>*</b>
                    <p >{{ $paciente->fecha_nacimiento }}</p>
                </div>
                </div>

                <div class="col-md-4">
                {{-- Genero --}}
                <div class="form-group mb-3">
                    <label for="genero">Género</label>
                    <p >{{ $paciente->genero }}</p>
                </div>
                </div>

                <div class="col-md-4">
                {{-- Telefono --}}
                <div class="form-group mb-3">
                    <label for="telefono">Teléfono</label>
                    <p >{{ $paciente->telefono }}</p>
                </div>
                </div>

            <div class="col-md-4">
                {{-- Correo --}}
                <div class="form-group mb-3">
                    <label for="email">Correo electrónico</label>
                    <p >{{ $paciente->correo }}</p>
                </div>
                </div>

                <div class="col-md-4">
                {{-- Direccion --}}
                <div class="form-group mb-3">
                    <label for="direccion">Dirección</label> <b>*</b>
                    <p >{{ $paciente->direccion }}</p>
                </div>
                </div>

                <div class="col-md-4">
                {{-- Grupo_Sanguineo --}}
                <div class="form-group mb-3">
                    <label for="grupo_sanguineo">Grupo sanguíneo</label>
                    <p >{{ $paciente->grupo_sanguineo }}</p>
                  </div>
                    </div>

                    <div class="col-md-4">
                  {{-- Alergias --}}
                  <div class="form-group mb-3">
                    <label for="alergias">Alergias</label>
                    <p >{{ $paciente->alergias }}</p>
                </div>
                </div>

                <div class="col-md-4">
                  {{-- Contacto_emergencia --}}
                  <div class="form-group mb-3">
                      <label for="contacto_emergencia">Contacto de emergencia</label>
                      <p >{{ $paciente->contacto_emergencia }}</p>
                  </div>
                    </div>

                   <div class="col-md-10">
                  {{-- Observaciones --}}
                    <div class="form-group mb-3">
                    <label for="observaciones">Observaciones</label>
                    <p >{{ $paciente->observaciones }}</p>
                    </div>
                    </div>
            </div>
                           
                {{-- BOTONES --}}
                <div class="text-right mt-4">
                    <a href="{{ route('admin.pacientes.index') }}" class="btn btn-secondary">
                        Regresar
                    </a>
                 
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
