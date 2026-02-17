@extends('layouts.admin')

@section('content')
<div class="row">
    <h1>Editar usuario</h1>
</div>

<hr>

<div class="row justify-content-center">
    <div class="col-md-6">

        <div class="card card-outline card-primary" style="max-width: 450px; margin: auto;">
            <div class="card-header text-center">
                <h3 class="card-title">Actualice los datos del usuario</h3>
            </div>

            <div class="card-body">

                {{-- FORMULARIO --}}
                <form action="{{ route('admin.usuarios.update', $usuario->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Nombre --}}
                    <div class="form-group mb-3">
                        <label for="name">Nombre completo</label> <b>*</b>
                        <input type="text" class="form-control" id="name" name="name" 
                               value="{{ $usuario->name }}" required>
                    </div>

                    {{-- Correo --}}
                    <div class="form-group mb-3">
                        <label for="email">Correo electrónico</label> <b>*</b>
                        <input type="email" class="form-control" id="email" name="email"
                               value="{{ $usuario->email }}" required>
                    </div>

                    {{-- BOTONES --}}
                    <div class="text-right mt-4">
                        <a href="{{ route('admin.usuarios.index') }}" class="btn btn-secondary">
                            Cancelar
                        </a>

                        <button type="submit" class="btn btn-primary">
                            Actualizar usuario
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>
</div>
@endsection
