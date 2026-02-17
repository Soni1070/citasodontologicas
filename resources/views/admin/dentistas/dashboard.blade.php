@extends('layouts.app') {{-- o layouts.admin --}}   

@section('content')

<h1>Agenda del Dr. {{ $dentista->nombres }}</h1>

<div class="mb-3">
    <button class="btn btn-primary" onclick="mostrarHoy()">Hoy</button>
    <button class="btn btn-secondary" onclick="mostrarSemana()">Semana</button>
</div>

<div id="agenda-hoy">
    <h4>Citas de Hoy</h4>

    @forelse($citasHoy as $cita)
        <div class="card mb-2">
            <div class="card-body">
                <strong>Paciente:</strong> {{ $cita->paciente->nombres }} {{ $cita->paciente->apellidos }} <br>
                <strong>Hora:</strong> {{ \Carbon\Carbon::parse($cita->fecha_inicio)->format('H:i') }} <br>
                <strong>Consultorio:</strong> {{ $cita->consultorio->nombre }} <br>
                <strong>Procedimiento:</strong> {{ $cita->procedimiento }}
            </div>
        </div>
    @empty
        <p>No tienes citas hoy.</p>
    @endforelse
</div>

<div id="agenda-semana" style="display:none;">
    <h4>Citas de la Semana</h4>

    @forelse($citasSemana as $cita)
        <div class="card mb-2">
            <div class="card-body">
                <strong>Paciente:</strong> {{ $cita->paciente->nombres }} {{ $cita->paciente->apellidos }} <br>
                <strong>Fecha:</strong> {{ \Carbon\Carbon::parse($cita->fecha_inicio)->format('d/m/Y H:i') }} <br>
                <strong>Consultorio:</strong> {{ $cita->consultorio->nombre }} <br>
                <strong>Procedimiento:</strong> {{ $cita->procedimiento }}
            </div>
        </div>
    @empty
        <p>No tienes citas esta semana.</p>
    @endforelse
</div>

@endsection

@push('scripts')
<script>
function mostrarHoy() {
    document.getElementById('agenda-hoy').style.display = 'block';
    document.getElementById('agenda-semana').style.display = 'none';
}

function mostrarSemana() {
    document.getElementById('agenda-hoy').style.display = 'none';
    document.getElementById('agenda-semana').style.display = 'block';
}
</script>
@endpush
