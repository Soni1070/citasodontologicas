@extends('layouts.admin')

@section('content')
<div class="row">
    <h1>Editar registro: {{ $secretaria->nombres }} {{ $secretaria->apellidos }}</h1>
</div>

<hr>

<div class="row justify-content-center">
    <div class="col-md-12">

        <div class="card card-outline card-warning" style="max-width: 1000px; margin: auto;">
            <div class="card-header text-center">
                <h3 class="card-title">Diligencie los datos</h3>
            </div>

            <div class="card-body">
            <form action="{{ route('admin.secretarias.update', $secretaria->id) }}" method="POST">
                @csrf
                @method('PUT')
        <div class="row">

                {{-- nombres --}}
                <div class="col-md-4">
                <div class="form-group mb-3">
                    <label for="name">Nombres</label> <b>*</b>
                    <input type="text" value="{{ $secretaria->nombres }}" class="form-control" id="name" name="nombres" required>
                    @error ('nombres')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                </div>

                {{-- apellidos --}}
                <div class="col-md-4">
                <div class="form-group mb-3">
                    <label for="apellidos">Apellidos</label> <b>*</b>
                    <input type="text" value="{{ $secretaria->apellidos }}" class="form-control" id="apellidos" name="apellidos" required>
                    @error ('apellidos')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                </div>

                {{-- documento --}}
                <div class="col-md-4">
                <div class="form-group mb-3">
                    <label for="documento">Documento</label> <b>*</b>
                    <input type="text" value="{{ $secretaria->documento }}" class="form-control" id="documento" name="documento" required>
                    @error ('documento')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                </div>

                {{-- teléfono --}}
                <div class="col-md-4">
                <div class="form-group mb-3">
                    <label for="telefono">Teléfono</label> <b>*</b>
                    <input type="text" value="{{ $secretaria->telefono }}" class="form-control" id="telefono" name="telefono" required>
                    @error ('telefono')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror   
                </div>
                </div>

                {{-- dirección --}}
                <div class="col-md-4">
                <div class="form-group mb-3">
                    <label for="direccion">Dirección</label> <b>*</b>
                    <input type="address" value="{{ $secretaria->direccion }}" class="form-control" id="direccion" name="direccion" required>
                    @error ('direccion')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                </div>

                {{-- fecha de nacimiento --}}
                <div class="col-md-4">
                <div class="form-group mb-3">
                    <label for="fecha_nacimiento">Fecha de nacimiento</label> <b>*</b>
                    <input type="date" value="{{ $secretaria->fecha_nacimiento }}" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
                    @error ('fecha_nacimiento')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror           
                </div>
                </div>


                {{-- Correo --}}
                <div class="col-md-4">
                <div class="form-group mb-3">
                    <label for="email">Correo electrónico</label> <b>*</b>
                    <input type="email" value="{{ $secretaria->user->email }}" class="form-control" id="email" name="email" required>
                    @error ('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                </div>

                {{-- Contraseña --}}
                <div class="col-md-4">
                <div class="form-group mb-3">
                    <label for="password">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password">
                    @error ('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                </div>

                {{-- Confirmación --}}
                <div class="col-md-4">
                <div class="form-group mb-3">
                    <label for="password_confirmation">Confirmar contraseña</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                    @error ('password_confirmation')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                </div>

            </div>
               
                {{-- BOTONES --}}
                <div class="text-right mt-4">
                    <a href="{{ route('admin.secretarias.index') }}" class="btn btn-secondary">
                        Cancelar
                    </a>

                    <button type="submit" class="btn btn-warning">
                        Actualizar
                    </button>
                 
                </div>
            </form>
            </div>
        </div>

    </div>
</div>
@endsection