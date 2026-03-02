@extends('layouts.admin')

@section('content')

<h1 class="mb-4">Mi Agenda</h1>

<div class="card">
    <div class="card-body">

    <div class="mb-3">
    <a href="{{ route('agenda.dentista', ['vista' => 'dia']) }}"
       class="btn btn-primary btn-sm">
        Hoy
    </a>

    <a href="{{ route('agenda.dentista', ['vista' => 'semana']) }}"
       class="btn btn-secondary btn-sm">
        Semana
    </a>

    <a href="{{ route('agenda.dentista', ['vista' => 'mes']) }}"
       class="btn btn-info btn-sm">
        Mes
    </a>

</div>

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Paciente</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Procedimiento</th>
                    <th>Consultorio</th>
                    <th>Estado</th>
                    <th>Cambiar estado</th>
                    <th>Historia Clínica</th>
                </tr>
            </thead>
            <tbody>
                @forelse($citas as $cita)
                <tr>
                    <td>
                        {{ $cita->paciente->nombres }}
                        {{ $cita->paciente->apellidos }}
                    </td>

                    <td>
                        {{ \Carbon\Carbon::parse($cita->fecha_inicio)->format('d/m/Y') }}
                    </td>

                    <td>
                        {{ \Carbon\Carbon::parse($cita->fecha_inicio)->format('H:i') }}
                        -
                        {{ \Carbon\Carbon::parse($cita->fecha_fin)->format('H:i') }}
                    </td>

                    <td>{{ $cita->procedimiento }}</td>
                    <td>{{ $cita->consultorio->nombre }}</td>

                    <!-- Inicio Estado de la cita -->
                     <td>
                        @switch($cita->estado)
                            @case('pendiente')
                                <span class="badge bg-warning">Pendiente</span>
                                @break
                            @case('confirmada')
                                <span class="badge bg-primary">Confirmada</span>
                                @break
                            @case('realizada')
                            <span class="badge bg-success">Realizada</span>
                                @break
                            @case('cancelada')
                                <span class="badge bg-danger">Cancelada</span>
                                @break

                            @case('no_asistio')
                                <span class="badge bg-dark">No asistió</span>
                                @break
                        @endswitch
                    </td>
                    <!-- Fin estado de la cita -->

{{-- Cambiar Estado --}}
<td>
    @if($cita->estado == 'realizada')
        <form action="{{ route('citas.desmarcarRealizada', $cita->id) }}"
              method="POST">
            @csrf
            @method('PATCH')
            <button class="btn btn-warning btn-sm">
                Deshacer
            </button>
        </form>

    @elseif($cita->estado == 'confirmada' || $cita->estado == 'pendiente')
        <form action="{{ route('citas.marcarRealizada', $cita->id) }}"
              method="POST">
            @csrf
            @method('PATCH')
            <button class="btn btn-success btn-sm">
                Marcar Realizada
            </button>
        </form>
    @else
        <span class="text-muted">—</span>
    @endif
</td>

{{-- Historia Clínica --}}
<td>
    <a href="{{ route('historia.show', $cita->paciente_id) }}"
       class="btn btn-info btn-sm">
        Historia Clínica
    </a>
</td>

                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center">
                        No tienes citas asignadas
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</div>

@endsection
