@extends('layouts.admin')

@section('content')
<div class="row">
    <h1>Registro nuevo consultorio</h1>
</div>

<hr>

<div class="row justify-content-center">
    <div class="col-md-12">

        <div class="card card-outline card-primary" style="max-width: 1000px; margin: auto;">
            <div class="card-header text-center">
                <h3 class="card-title">Diligencie los datos</h3>
            </div>

            <div class="card-body">
            <form action="{{ route('admin.consultorios.store') }}" method="POST">
                @csrf

        <div class="row">
                <div class="col-md-4">
                {{-- Consultorio --}}
                <div class="form-group mb-3">
                    <label for="nombre">Nombre del consultorio</label> <b>*</b>
                    <input type="text" value="{{ old('nombre') }}" class="form-control" id="nombre" name="nombre" required>
                    @error ('nombre')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                </div>

                <div class="col-md-4">
                {{-- Ubicacion --}}
                <div class="form-group mb-3">
                    <label for="ubicacion">Ubicacion</label> <b>*</b>
                    <select class="form-control" id="ubicacion" name="ubicacion" required>
                        <option value="" disabled selected>Seleccione ubicacion</option>
                        <option value="piso1">Piso 1</option>
                        <option value="piso2">Piso 2</option>
                        <option value="piso3">Piso 3</option>
                    </select>
                    @error ('ubicacion')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                </div>

                <div class="col-md-4">
                {{-- Capacidad --}}
                <div class="form-group mb-3">
                    <label for="capacidad">Capacidad</label> <b>*</b>
                    <select class="form-control" id="capacidad" name="capacidad" required>
                        <option value="" disabled selected>Seleccione capacidad</option>
                        <option value="1" {{ old('capacidad') == 1 ? 'selected' : '' }}>1 persona</option>
                        <option value="2" {{ old('capacidad') == 2 ? 'selected' : '' }}>2 personas</option>
                        <option value="3" {{ old('capacidad') == 3 ? 'selected' : '' }}>3 personas</option>
                    </select>
                    @error ('capacidad')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                </div>

                <div class="col-md-4">
                {{-- Telefono --}}
                <div class="form-group mb-3">
                    <label for="telefono">Telefono</label>
                    <input type="text" value="{{ old('telefono') }}" class="form-control" id="telefono" name="telefono" required>
                    @error ('telefono')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                </div>

                <div class="col-md-4">
                {{-- Especialidad --}}
                <div class="form-group mb-3">
                    <label for="especialidad">Especialidad</label> <b>*</b>
                    <select class="form-control" id="especialidad" name="especialidad" required>
                        <option value="" disabled selected>Seleccione especialidad</option>
                        <option value="Odontología General">Odontología General</option>
                        <option value="Endodoncia">Endodoncia</option>
                        <option value="Ortodoncia">Ortodoncia</option>
                        <option value="Periodoncia">Periodoncia</option>
                        <option value="Cirugía Oral">Cirugía Oral</option>
                        <option value="Prostodoncia">Prostodoncia</option>
                        <option value="Odontopediatría">Odontopediatría</option>
                    </select>
                    @error ('especialidad')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                </div>

                <div class="col-md-4">
                {{-- Estado --}}
                <div class="form-group mb-3">
                    <label for="estado">Estado</label> <b>*</b>
                    <select class="form-control" id="estado" name="estado" required>
                        <option value="" disabled selected>Seleccione estado</option>
                        <option value="Activo">Activo</option>
                        <option value="Inactivo">Inactivo</option>
                    </select>
                    @error ('estado')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                </div>

        </div>
                           
                {{-- BOTONES --}}
                <div class="text-right mt-4">
                    <a href="{{ route('admin.consultorios.index') }}" class="btn btn-secondary">
                        Cancelar
                    </a>

                    <button type="submit" class="btn btn-primary">
                        Registro de Consultorio
                    </button>
                 
                </div>
            </form>
            </div>
        </div>

    </div>
</div>
@endsection
