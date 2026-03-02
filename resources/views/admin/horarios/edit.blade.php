@extends('layouts.admin')

@section('content')

<div class="row">
    <h1>Editar Horario</h1>
</div>

<hr>

<div class="row justify-content-center">
    <div class="col-md-12">

        <div class="card card-outline card-warning" style="max-width: 1000px; margin: auto;">
            <div class="card-header text-center">
                <h3 class="card-title">Actualizar Horario</h3>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.horarios.update', $horario->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">

                    {{-- Consultorio --}}
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Consultorio</label> <b>*</b>
                                <select name="consultorio_id" class="form-control" required>
                                    @foreach($consultorios as $consultorio)
                                        <option value="{{ $consultorio->id }}"
                                            {{ $horario->consultorio_id == $consultorio->id ? 'selected' : '' }}>
                                            {{ $consultorio->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('consultorio_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        {{-- Especialista --}}
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Especialista</label> <b>*</b>
                                <select name="dentista_id" class="form-control" required>
                                    @foreach($dentistas as $dentista)
                                        <option value="{{ $dentista->id }}"
                                            {{ $horario->dentista_id == $dentista->id ? 'selected' : '' }}>
                                            {{ $dentista->nombres }} {{ $dentista->apellidos }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('dentista_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        {{-- Día --}}
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label>Día</label> <b>*</b>
                                <input type="text"
                                       name="dia"
                                       value="{{ old('dia', $horario->dia) }}"
                                       class="form-control"
                                       required>
                                @error('dia')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        {{-- Hora Inicio --}}
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label>Hora Inicio</label> <b>*</b>
                                <input type="time"
                                       name="hora_inicio"
                                       value="{{ old('hora_inicio', $horario->hora_inicio) }}"
                                       class="form-control"
                                       required>
                                @error('hora_inicio')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        {{-- Hora Fin --}}
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label>Hora Fin</label> <b>*</b>
                                <input type="time"
                                       name="hora_fin"
                                       value="{{ old('hora_fin', $horario->hora_fin) }}"
                                       class="form-control"
                                       required>
                                @error('hora_fin')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>


                    </div>

                    <div class="text-right mt-4">
                        <a href="{{ route('admin.horarios.index') }}" class="btn btn-secondary">
                            Cancelar
                        </a>

                        <button type="submit" class="btn btn-warning">
                            Actualizar Horario
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>

@endsection