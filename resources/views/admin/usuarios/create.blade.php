@extends('layouts.admin')

@section('content')
<div class="row">
    <h1>Registro de usuario nuevo</h1>
</div>

<hr>

<div class="row justify-content-center">
    <div class="col-md-6">

        <div class="card card-outline card-primary" style="max-width: 450px; margin: auto;">
            <div class="card-header text-center">
                <h3 class="card-title">Diligencie los datos</h3>
            </div>

            <div class="card-body">
            <form action="{{ route('admin.usuarios.store') }}" method="POST">
                @csrf

                {{-- Nombre --}}
                <div class="form-group mb-3">
                    <label for="name">Nombre completo</label> <b>*</b>
                    <input type="text" value="{{ old('name') }}" class="form-control" id="name" name="name" required>
                    @error ('name')
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

                <div class="form-group">
        <label for="role">Rol</label>
        <select name="role" class="form-control" required>
            <option value="">Seleccione un rol</option>
            <option value="secretaria">Secretaria</option>
            <option value="dentista">Dentista</option>
            <option value="paciente">Paciente</option>
            {{-- admin solo si tú quieres --}}
            {{-- <option value="admin">Administrador</option> --}}
        </select>
    </div>
               
                {{-- BOTONES --}}
                <div class="text-right mt-4">
                    <a href="{{ route('admin.usuarios.index') }}" class="btn btn-secondary">
                        Cancelar
                    </a>

                    <button type="submit" class="btn btn-primary">
                        Registrar usuario
                    </button>
                 
                </div>
            </form>
            </div>
        </div>

    </div>
</div>
@endsection




