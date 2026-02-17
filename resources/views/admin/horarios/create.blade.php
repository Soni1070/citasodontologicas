@extends('layouts.admin')

@section('content')
<div class="row">
    <h1>Nuevo Registro de Horario</h1>
</div>

<hr>

<div class="row justify-content-center">
    <div class="col-md-12">

        <div class="card card-outline card-primary" style="max-width: 1000px; margin: auto;">
            <div class="card-header text-center">
                <h3 class="card-title">Diligencie los datos</h3>
            </div>

            <div class="card-body">
            <form action="{{ route('admin.horarios.store') }}" method="POST">
                @csrf
        <div class="row">
            
                {{-- consultorio --}}
                <div class="col-md-4">
                <div class="form-group mb-4">
                    <label for="consultorio_id">Consultorio</label> <b>*</b>
                    <select name="consultorio_id" id="consultorio_id" class="form-control" required>
                        <option value="" disabled selected>Seleccione un consultorio</option>
                        @foreach ($consultorios as $consultorio)
                            <option value="{{ $consultorio->id }}">
                                {{ $consultorio->nombre }} {{ $consultorio->ubicacion }}
                            </option>
                        @endforeach
                    </select>
                </div>
                </div>

                {{-- dentistas --}}
                <div class="col-md-4">
                <div class="form-group mb-4">
                    <label for="dentista_id">Especialista</label> <b>*</b>
                    <select name="dentista_id" id="dentista_id" class="form-control" required>
                        <option value="" disabled selected>Seleccione un especialista</option>
                        @foreach ($dentistas as $dentista)
                            <option value="{{ $dentista->id }}">
                                {{ $dentista->nombres }} {{ $dentista->apellidos }} - {{ $dentista->especialidad }}
                            </option>
                        @endforeach
                    </select>
                </div>
                </div>

                {{-- días --}}
                <div class="col-md-4">
                <div class="form-group mb-3">
                    <label for="name">Día</label> <b>*</b>
                    <select name= "dia" id="" class="form-control" required>
                        <option value="" disabled selected>Seleccione un día</option>
                        <option value="Lunes">Lunes</option>
                        <option value="Martes">Martes</option>
                        <option value="Miércoles">Miércoles</option>
                        <option value="Jueves">Jueves</option>
                        <option value="Viernes">Viernes</option>
                        <option value="Sábado">Sábado</option>
                        <option value="Domingo">Domingo</option>
                    </select>
                </div>
                </div>

                {{-- hora inicio --}}
                <div class="col-md-4">
                <div class="form-group mb-3">
                    <label for="hora_inicio">Hora Inicio</label> <b>*</b>
                    <input type="time" value="{{ old('hora_inicio') }}" class="form-control" id="hora_inicio" name="hora_inicio" required>
                    @error ('hora_inicio')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                </div>

                {{-- hora fin --}}
                <div class="col-md-4">
                <div class="form-group mb-3">
                    <label for="hora_fin">Hora Fin</label> <b>*</b>
                    <input type="time" value="{{ old('hora_fin') }}" class="form-control" id="hora_fin" name="hora_fin" required>
                    @error ('hora_fin')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                </div>

        </div>  

        <div class="col-md-6">
    <div class="card">
        <div class="card-header bg-info">
            <strong>Agenda del consultorio</strong>
        </div>

        <div class="card-body">
            <table class="table table-bordered table-sm" id="agendaConsultorio"
                     data-url="{{ route('admin.horarios.consultorio', ':id') }}">
                <thead>
                    <tr>
                        <th>Día</th>
                        <th>Horario</th>
                        <th>Especialista</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="3" class="text-center">
                            Seleccione un consultorio
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
                {{-- BOTONES --}}
                <div class="text-right mt-4">
                    <a href="{{ route('admin.horarios.index') }}" class="btn btn-secondary">
                        Cancelar
                    </a>

                    <button type="submit" class="btn btn-primary">
                        Registrar nuevo
                    </button>
                 
                </div>
            </form>
            </div>
        </div>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const selectConsultorio = document.getElementById('consultorio_id');
    const table = document.getElementById('agendaConsultorio');
    const tbody = table.querySelector('tbody');

    selectConsultorio.addEventListener('change', function () {

        let consultorioId = this.value;

        if (!consultorioId) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="3" class="text-center">
                        Seleccione un consultorio
                    </td>
                </tr>
            `;
            return;
        }

        tbody.innerHTML = `
            <tr>
                <td colspan="3" class="text-center">Cargando...</td>
            </tr>
        `;

        // 🔥 AQUÍ ESTÁ LA CLAVE
        let url = table.dataset.url.replace(':id', consultorioId);

        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {

            tbody.innerHTML = '';

            if (data.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="3" class="text-center">
                            No hay horarios registrados
                        </td>
                `;
                return;
            }

            data.forEach(horario => {
                tbody.innerHTML += `
                    <tr>
                        <td>${horario.dia}</td>
                        <td>${horario.hora_inicio} - ${horario.hora_fin}</td>
                        <td>
                            ${horario.dentista
                                ? horario.dentista.nombres + ' ' + horario.dentista.apellidos
                                : 'No asignado'}
                        </td>
                    </tr>
                `;
            });
        })
        .catch(() => {
            tbody.innerHTML = `
                <tr>
                    <td colspan="3" class="text-center text-danger">
                        Error al cargar la agenda
                    </td>
                </tr>
            `;
        });
    });
});
</script>
@endsection
