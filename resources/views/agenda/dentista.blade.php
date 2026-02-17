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
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">
                        No tienes citas asignadas
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</div>

@endsection
