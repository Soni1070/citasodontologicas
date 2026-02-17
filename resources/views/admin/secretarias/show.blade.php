@extends('layouts.admin')

@section('content')
<div class="row">
    <h1>Secretaria: {{ $secretaria->nombres }} {{ $secretaria->apellidos }}</h1>
</div>

<hr>

<div class="row justify-content-center">
    <div class="col-md-10 col-lg-8">

        <div class="card card-outline card-info">
            <div class="card-header text-center">
                <h3 class="card-title">Datos registrados</h3>
            </div>

            <div class="card-body">
            
                {{-- nombres --}}
                <div class="form-group mb-3">
                    <label for="name">Nombres</label> <b>*</b>
                    <p>{{ $secretaria->nombres }}</p>
                    @error ('nombres')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- apellidos --}}
                <div class="form-group mb-3">
                    <label for="apellidos">Apellidos</label> <b>*</b>
                    <p>{{ $secretaria->apellidos }}</p>
                    @error ('apellidos')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- documento --}}
                <div class="form-group mb-3">
                    <label for="documento">Documento</label> <b>*</b>
                    <p>{{ $secretaria->documento }}</p>
                    @error ('documento')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- teléfono --}}
                <div class="form-group mb-3">
                    <label for="telefono">Teléfono</label> <b>*</b>
                    <p>{{ $secretaria->telefono }}</p>
                    @error ('telefono')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror   
                </div>

                {{-- dirección --}}
                <div class="form-group mb-3">
                    <label for="direccion">Dirección</label> <b>*</b>
                    <p>{{ $secretaria->direccion }}</p>
                    @error ('direccion')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                {{-- fecha de nacimiento --}}
                <div class="form-group mb-3">
                    <label for="fecha_nacimiento">Fecha de nacimiento</label> <b>*</b>
                    <p>{{ $secretaria->fecha_nacimiento }}</p>
                    @error ('fecha_nacimiento')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror           
                </div>

                {{-- Correo --}}
                <div class="form-group mb-3">
                    <label for="email">Correo electrónico</label> <b>*</b>
                    <p>{{ $secretaria->user->email }}</p>
                    @error ('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>


                {{-- BOTONES --}}
                <div class="text-right mt-4">
                    <a href="{{ route('admin.secretarias.index') }}" class="btn btn-secondary">
                        Regresar
                    </a>
                 
                </div>
            </form>
            </div>
        </div>

    </div>
</div>
@endsection