@extends('layouts.admin')

@section('content')

<div class="row">
    <h1>Detalle del usuario</h1>
</div>

<hr>

<div class="row justify-content-center">
    <div class="col-md-6">
        
        <div class="card">
            <div class="card-header">
                <h4>Información del usuario</h4>
            </div>

            <div class="card-body">

                <p><strong>Nombre:</strong> {{ $usuario->name }}</p>
                <p><strong>Correo:</strong> {{ $usuario->email }}</p>

            </div>
        </div>

        <a href="{{ route('admin.usuarios.index') }}" class="btn btn-secondary mt-3">
            Volver
        </a>
    </div>
</div>

@endsection