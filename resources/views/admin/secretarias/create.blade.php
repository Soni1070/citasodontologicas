@extends('layouts.admin')

@section('content')
<div class="row">
    <h1>Nuevo registro</h1>
</div>

<hr>

<div class="row justify-content-center">
    <div class="col-md-10 col-lg-8">

        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <h3 class="card-title">Diligencie los datos</h3>
            </div>

            <div class="card-body">
            <form action="{{ route('admin.secretarias.store') }}" method="POST">
                @csrf

                {{-- nombres --}}
                <div class="form-group mb-3">
                    <label for="name">Nombres</label> <b>*</b>
                    <input type="text" value="{{ old('name') }}" class="form-control" id="name" name="nombres" required>
                    @error ('nombres')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- apellidos --}}
                <div class="form-group mb-3">
                    <label for="apellidos">Apellidos</label> <b>*</b>
                    <input type="text" value="{{ old('apellidos') }}" class="form-control" id="apellidos" name="apellidos" required>
                    @error ('apellidos')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- documento --}}
                <div class="form-group mb-3">
                    <label for="documento">Documento</label> <b>*</b>
                    <input type="text" value="{{ old('documento') }}" class="form-control" id="documento" name="documento" required>
                    @error ('documento')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- teléfono --}}
                <div class="form-group mb-3">
                    <label for="telefono">Teléfono</label> <b>*</b>
                    <input type="text" value="{{ old('telefono') }}" class="form-control" id="telefono" name="telefono" required>
                    @error ('telefono')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror   
                </div>

                {{-- dirección --}}
                <div class="form-group mb-3">
                    <label for="direccion">Dirección</label> <b>*</b>
                    <input type="address" value="{{ old('direccion') }}" class="form-control" id="direccion" name="direccion" required>
                    @error ('direccion')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                
                {{-- fecha de nacimiento --}}
                <div class="form-group mb-3">
                    <label for="fecha_nacimiento">Fecha de nacimiento</label> <b>*</b>
                    <input type="date" value="{{ old('fecha_nacimiento') }}" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
                    @error ('fecha_nacimiento')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror           
                </div>

                {{-- Correo --}}
                <div class="form-group mb-3">
                    <label for="email">Correo electrónico</label> <b>*</b>
                    <input type="email" value="{{ old('email') }}" class="form-control" id="email" name="email" required>
                    @error ('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Contraseña --}}
                <div class="form-group mb-3">
                    <label for="password">Contraseña</label> <b>*</b>
                    <input type="password" class="form-control" id="password" name="password" required>
                    @error ('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Confirmación --}}
                <div class="form-group mb-3">
                    <label for="password_confirmation">Confirmar contraseña</label> <b>*</b>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                    @error ('password_confirmation')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
               
                {{-- BOTONES --}}
                <div class="text-right mt-4">
                    <a href="{{ route('admin.secretarias.index') }}" class="btn btn-secondary">
                        Cancelar
                    </a>

                    <button type="submit" class="btn btn-primary">
                        Registrar nuevo
                    </button>
                 
                </div>
            </form>
            </div>
        </div>

    </div>
</div>
@endsection
