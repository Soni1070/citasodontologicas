@extends('layouts.admin')

@section('content')
<div class="row">
    <h1>Actualizar consultorio: {{ $consultorio->nombre }}</h1>
</div>

<hr>

<div class="row justify-content-center">
    <div class="col-md-12">

        <div class="card card-outline card-warning" style="max-width: 1000px; margin: auto;">
            <div class="card-header text-center">
                <h3 class="card-title">Diligencie los datos</h3>
            </div>

            <div class="card-body">
            <form action="{{ route('admin.consultorios.update', $consultorio->id) }}" method="POST">
                @csrf
                @method('PUT')

        <div class="row">
                <div class="col-md-4">
                {{-- Consultorio --}}
                <div class="form-group mb-3">
                    <label for="nombre">Nombre del consultorio</label> <b>*</b>
                    <input type="text" value="{{ old('nombre', $consultorio->nombre) }}" class="form-control" id="nombre" name="nombre" required>
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
                        <option value="" disabled {{ old('ubicacion', $consultorio->ubicacion) ? '' : 'selected' }}>
                            Seleccione ubicación </option>
                        <option value="piso1" {{ old('ubicacion', $consultorio->ubicacion) == 'piso1' ? 'selected' : '' }}>
                            Piso 1 </option>
                        <option value="piso2" {{ old('ubicacion', $consultorio->ubicacion) == 'piso2' ? 'selected' : '' }}>
                            Piso 2 </option>   
                        <option value="piso3" {{ old('ubicacion', $consultorio->ubicacion) == 'piso3' ? 'selected' : '' }}>
                            Piso 3 </option>
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
                        <option value="" disabled {{ old('capacidad', $consultorio->capacidad) ? '' : 'selected' }}>
                            Seleccione capacidad </option>
                        <option value="1" {{ old('capacidad', $consultorio->capacidad) == 1 ? 'selected' : '' }}>1 persona</option>
                        <option value="2" {{ old('capacidad', $consultorio->capacidad) == 2 ? 'selected' : '' }}>2 personas</option>
                        <option value="3" {{ old('capacidad', $consultorio->capacidad) == 3 ? 'selected' : '' }}>3 personas</option>
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
                    <input type="text" value="{{ old('telefono', $consultorio->telefono) }}" class="form-control" id="telefono" name="telefono" required>
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
                        <option value="" disabled {{ old('especialidad', $consultorio->especialidad) ? '' : 'selected' }}>
                            Seleccione especialidad </option>
                        <option value="Odontología General">Odontología General</option>
                        <option value="Endodoncia" {{ old('especialidad', $consultorio->especialidad) == 'Endodoncia' ? 'selected' : '' }}>Endodoncia</option>
                        <option value="Ortodoncia" {{ old('especialidad', $consultorio->especialidad) == 'Ortodoncia' ? 'selected' : '' }}>Ortodoncia</option>
                        <option value="Periodoncia" {{ old('especialidad', $consultorio->especialidad) == 'Periodoncia' ? 'selected' : '' }}>Periodoncia</option>
                        <option value="Cirugía Oral" {{ old('especialidad', $consultorio->especialidad) == 'Cirugía Oral' ? 'selected' : '' }}>Cirugía Oral</option>
                        <option value="Prostodoncia" {{ old('especialidad', $consultorio->especialidad) == 'Prostodoncia' ? 'selected' : '' }}>Prostodoncia</option>
                        <option value="Odontopediatría" {{ old('especialidad', $consultorio->especialidad) == 'Odontopediatría' ? 'selected' : '' }}>Odontopediatría</option>
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
                        <option value="" disabled {{ old('estado', $consultorio->estado) ? '' : 'selected' }}>
                            Seleccione estado </option>
                        <option value="Activo" {{ old('estado', $consultorio->estado) == 'Activo' ? 'selected' : '' }}>Activo</option>
                        <option value="Inactivo" {{ old('estado', $consultorio->estado) == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
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

                    <button type="submit" class="btn btn-warning">
                        Actualizar consultorio
                    </button>
                 
                </div>
            </form>
            </div>
        </div>

    </div>
</div>
@endsection
