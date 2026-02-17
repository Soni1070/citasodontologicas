@extends('layouts.admin')

@section('content')
<div class="row">
    <h1>Horarios asignados</h1>
</div>

<hr>

<div class="row justify-content-center">
    <div class="col-md-12">

        <div class="card card-outline card-info" style="max-width: 1000px; margin: auto;">
            <div class="card-header text-center">
                <h3 class="card-title">Horarios asignados</h3>
            </div>

            <div class="card-body">
            
        <div class="row">
            {{-- dentistas --}}
                <div class="col-md-4">
                <div class="form-group mb-4">
                    <label for="dentista_id">Especialista</label>
                    <p>{{ $horario->dentista->nombres }}  {{ $horario->dentista->apellidos }} - {{ $horario->dentista->especialidad }}</p>
                    @error ('dentista_id')
                        <small class="text-danger">{{ $message }}</small>   
                    @enderror
                </div>
                </div>

                {{-- consultorio --}}
                <div class="col-md-4">
                <div class="form-group mb-4">
                    <label for="consultorio_id">Consultorio</label>
                    <p>{{ $horario->consultorio->nombre }} - {{ $horario->consultorio->ubicacion }}</p>
                    @error ('consultorio_id')
                        <small class="text-danger">{{ $message }}</small>   
                    @enderror
                </div>
                </div>

                {{-- días --}}
                <div class="col-md-4">
                <div class="form-group mb-3">
                    <label for="name">Día de atención</label>
                    <p>{{ $horario->dia }}</p>
                    @error ('dia')
                        <small class="text-danger">{{ $message }}</small>   
                    @enderror
                </div>
                </div>

                {{-- hora inicio --}}
                <div class="col-md-4">
                <div class="form-group mb-3">
                    <label for="hora_inicio">Hora Inicio</label>
                    <p>{{ $horario->hora_inicio }}</p>
                    @error ('hora_inicio')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                </div>

                {{-- hora fin --}}
                <div class="col-md-4">
                <div class="form-group mb-3">
                    <label for="hora_fin">Hora Fin</label>
                    <p>{{ $horario->hora_fin }}</p>
                    @error ('hora_fin')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                </div>
        </div>  
               
                {{-- BOTONES --}}
                <div class="text-right mt-4">
                    <a href="{{ route('admin.horarios.index') }}" class="btn btn-secondary">
                        Regresar
                    </a>

                </div>
            </div>
        </div>

    </div>
</div>
@endsection
