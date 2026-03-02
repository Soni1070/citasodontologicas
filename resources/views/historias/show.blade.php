@extends('layouts.admin')

@section('content')

<h3 class="mb-4">
    Historia Clínica - {{ $paciente->nombres }} {{ $paciente->apellidos }}
</h3>

<div class="row">

    <!-- Historia Clínica -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-primary text-white">
                Edición de Historia Clínica
            </div>

            <div class="card-body">

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('historia.update', $historia->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group mb-3">
                        <label>Antecedentes Médicos</label>
                        <textarea name="antecedentes_medicos" class="form-control" rows="2">
                            {{ $historia->antecedentes_medicos }}
                        </textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label>Enfermedades Sistémicas</label>
                        <textarea name="enfermedades_sistemicas" class="form-control" rows="2">
                            {{ $historia->enfermedades_sistemicas }}
                        </textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label>Medicamentos Actuales</label>
                        <textarea name="medicamentos_actuales" class="form-control" rows="2">
                            {{ $historia->medicamentos_actuales }}
                        </textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label>Antecedentes Odontológicos</label>
                        <textarea name="antecedentes_odontologicos" class="form-control" rows="2">
                            {{ $historia->antecedentes_odontologicos }}
                        </textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label>Observaciones Generales</label>
                        <textarea name="observaciones_generales" class="form-control" rows="2">
                            {{ $historia->observaciones_generales }}
                        </textarea>
                    </div>

                    <button type="submit" class="btn btn-success">
                        Guardar Historia Clínica
                    </button>
                </form>

            </div>
        </div>
    </div>

    <!-- Seguimientos del Paciente -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-secondary text-white">
                Seguimientos del Paciente
            </div>

            <div class="card-body" style="max-height:600px; overflow-y:auto;">

                @forelse($citas as $cita)
                    <div class="mb-3 border rounded p-2">
                        <strong>
                            Cita:
                            {{ \Carbon\Carbon::parse($cita->fecha_inicio)->format('d/m/Y H:i') }}
                        </strong>

                        @if($cita->seguimientos->isEmpty())
                            <p class="text-muted mt-2">
                                No hay seguimientos registrados.
                            </p>
                        @endif

                        @foreach($cita->seguimientos as $seguimiento)
                            <div class="bg-light p-2 mt-2 rounded">
                                {{ $seguimiento->descripcion }}
                                <br>
                                <small class="text-muted">
                                    {{ $seguimiento->created_at->format('d/m/Y H:i') }}
                                    -
                                    Dr(a). {{ $seguimiento->cita->dentista->nombres }}
                                    {{ $seguimiento->cita->dentista->apellidos }}
                                </small>
                            </div>
                        @endforeach
                    </div>
                @empty
                    <p>No hay citas registradas.</p>
                @endforelse

            </div>
        </div>
    </div>

</div>

@endsection