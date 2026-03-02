@extends('layouts.admin')

@section('content')
<div class="row mb-3">
    <div class="col-12">
        <h1>Agenda de Citas</h1>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card card-outline card-primary">
            <div class="card-body">

    <!-- Botón Ver Listado -->
    <div class="d-flex justify-content-end mb-3">
        <button class="btn btn-outline-primary"
                data-toggle="modal"
                data-target="#modalListadoCitas">
            Ver listado citas
        </button>
    </div>

    <div id="calendar"></div>
</div>
        </div>
    </div>
</div>

<!-- Modal Crear Cita -->
<div class="modal fade" id="modalCita" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header bg-primary">
        <h5 class="modal-title" id="tituloModalCita">Nueva Cita</h5>
        <button type="button" class="close" data-dismiss="modal">
          <span>&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form id="formCita">

        <input type="hidden" id="cita_id">
  
        <input type="hidden" id="fecha">

          <div class="form-group">
            <label>Hora inicio</label>
            <input type="time" id="hora_inicio" class="form-control" required>
          </div>

          <div class="form-group">
            <label>Hora fin</label>
            <input type="time" id="hora_fin" class="form-control" required>
          </div>

          <div class="form-group">
            <label>Paciente</label>
            <select id="paciente_id" class="form-control">
              <option value="">Seleccione</option>
              @foreach($pacientes as $paciente)
                <option value="{{ $paciente->id }}">
                  {{ $paciente->nombres }} {{ $paciente->apellidos }}
                </option>
              @endforeach
            </select>
          </div>



          <div class="form-group">
            <label>Dentista</label>
            <select id="dentista_id" class="form-control">
              <option value="">Seleccione</option>
              @foreach($dentistas as $dentista)
                <option value="{{ $dentista->id }}">
                  {{ $dentista->nombres }} {{ $dentista->apellidos }} - {{ $dentista->especialidad }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label>Procedimiento</label>
            <input type="text" id="procedimiento" class="form-control" required>
          </div>

        <!-- Agregar campo estado -->
        <div class="form-group">
            <label>Estado</label>
            <select id="estado" class="form-control">
              <option value="pendiente">Pendiente</option>
              <option value="confirmada">Confirmada</option>
              <option value="realizada">Realizada</option>
              <option value="cancelada">Cancelada</option>
              <option value="no_asistio">No asistió</option>
            </select>
          </div>
          <!-- Fin campo estado -->

        </form>
      </div>

      <div class="modal-footer">
        <button type="button" id="btnEliminar" class="btn btn-danger">
        Eliminar
        </button>

        <button class="btn btn-secondary" data-dismiss="modal">
        Cancelar
        </button>
        
        <button type="button" class="btn btn-primary" id="guardarCita">
        Guardar
        </button>

        <a href="#" id="btnHistoria" class="btn btn-info" style="display:none;">
        Historia Clínica
        </a>
      </div>

    </div>
  </div>
</div>

<!-- Inicio sección- Modal Listado de Citas -->
<div class="modal fade" id="modalListadoCitas" tabindex="-1">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">

      <div class="modal-header bg-info">
        <h5 class="modal-title">Listado de Citas</h5>
        <button type="button" class="close" data-dismiss="modal">
          <span>&times;</span>
        </button>
      </div>

      <div class="modal-body">

        <table class="table table-bordered table-sm">
          <thead class="bg-light">
            <tr>
              <th>Fecha</th>
              <th>Hora</th>
              <th>Paciente</th>
              <th>Dentista</th>
              <th>Estado</th>
            </tr>
          </thead>
          <tbody>
            @foreach($citasTabla as $cita)
            <tr>
              <td>{{ \Carbon\Carbon::parse($cita->inicio)->format('d/m/Y') }}</td>
              <td>{{ \Carbon\Carbon::parse($cita->inicio)->format('H:i') }}</td>
              <td>{{ $cita->paciente->nombres }} {{ $cita->paciente->apellidos }}</td>
              <td>{{ $cita->dentista->nombres }} {{ $cita->dentista->apellidos }}</td>
              <td>
                <span class="badge
                  @if($cita->estado == 'pendiente') badge-warning
                  @elseif($cita->estado == 'confirmada') badge-primary
                  @elseif($cita->estado == 'realizada') badge-success
                  @elseif($cita->estado == 'cancelada') badge-danger
                  @else badge-secondary
                  @endif
                ">
                  {{ ucfirst($cita->estado) }}
                </span>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>

      </div>

    </div>
  </div>
</div>

<!-- Fin sección - Modal listado de citas-->

@endsection

@push('scripts')
<script>
let calendar;

document.addEventListener('DOMContentLoaded', function () {

    const calendarEl = document.getElementById('calendar');

    calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'es',
        height: 650,

        headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridDay,dayGridWeek'
    },

        events: @json($citas),

        eventTimeFormat: {
        hour: '2-digit',
        minute: '2-digit',
        hour12: false
      },
        
        dateClick: function(info) {

    const hoy = new Date();
    hoy.setHours(0,0,0,0);

    const fechaSeleccionada = new Date(info.dateStr);

    if (fechaSeleccionada < hoy) {
        mostrarToast('No puedes agendar citas en fechas pasadas', 'danger');
        return;
    }

    document.getElementById('tituloModalCita').innerText = 'Nueva Cita';
    document.getElementById('formCita').reset();
    document.getElementById('cita_id').value = '';
    document.getElementById('btnEliminar').style.display = 'none';
    document.getElementById('fecha').value = info.dateStr;
    document.getElementById('btnHistoria').style.display = 'none';

    $('#modalCita').modal('show');
},

    eventClick: function(info) {

    const hoy = new Date();
    hoy.setHours(0,0,0,0);

    abrirModalEditar(info.event);

    // Para que funcione el botón de historia clínica, se necesita el ID del paciente
    const pacienteId = info.event.extendedProps.paciente_id;
    const btnHistoria = document.getElementById('btnHistoria');

    if (pacienteId) {
        btnHistoria.style.display = 'inline-block';
        btnHistoria.href = "{{ url('historia') }}/" + pacienteId;
    } else {
        btnHistoria.style.display = 'none';
    }

    if (info.event.start < hoy) {
        mostrarToast('Cita pasada solo lectura', 'warning');
        // Deshabilitar botón guardar
        document.getElementById('guardarCita').disabled = true;
        document.getElementById('btnEliminar').style.display = 'none';
        } else {
        document.getElementById('guardarCita').disabled = false;
        }

    },

      eventDidMount: function(info) {
        const hoy = new Date();
        hoy.setHours(0,0,0,0);

        if (info.event.start < hoy) {
            info.el.style.opacity = '0.6';
        }
    }

    });

    calendar.render();
});

function abrirModalEditar(event) {

    document.getElementById('tituloModalCita').innerText = 'Editar Cita';

    document.getElementById('cita_id').value = event.id;

    const start = event.start;
    const end = event.end;

    document.getElementById('fecha').value = start.toISOString().split('T')[0];
    document.getElementById('hora_inicio').value = start.toTimeString().slice(0,5);
    document.getElementById('hora_fin').value = end.toTimeString().slice(0,5);
    document.getElementById('estado').value = event.extendedProps.estado ?? 'pendiente';

    document.getElementById('paciente_id').value =
    String(event.extendedProps.paciente_id);

    document.getElementById('dentista_id').value =
    String(event.extendedProps.dentista_id);

    document.getElementById('procedimiento').value =
    event.extendedProps.procedimiento;

    // CONFIGURAR BOTÓN HISTORIA
    const btnHistoria = document.getElementById('btnHistoria');
    btnHistoria.href = "{{ url('historia') }}/" + event.extendedProps.paciente_id;
    btnHistoria.style.display = 'inline-block';


    //  MOSTRAR BOTÓN ELIMINAR
    document.getElementById('btnEliminar').style.display = 'inline-block';

    $('#modalCita').modal('show');
}
function mostrarToast(mensaje, tipo = 'success') {
    const toast = document.createElement('div');
    toast.className = `alert alert-${tipo}`;
    toast.style.position = 'fixed';
    toast.style.top = '20px';
    toast.style.right = '20px';
    toast.style.zIndex = 9999;
    toast.innerText = mensaje;

    document.body.appendChild(toast);

    setTimeout(() => toast.remove(), 3000);
}

</script>
@endpush

@push('scripts')
<script>
document.getElementById('guardarCita').addEventListener('click', function () {

    const citaId = document.getElementById('cita_id').value;

    const fecha = document.getElementById('fecha').value;
    const horaInicio = document.getElementById('hora_inicio').value;
    const horaFin = document.getElementById('hora_fin').value;

    const paciente = document.getElementById('paciente_id').value;
    const dentista = document.getElementById('dentista_id').value;
    const procedimiento = document.getElementById('procedimiento').value;

    if (!fecha || !horaInicio || !horaFin || !paciente || !dentista || !procedimiento) {
        alert('Todos los campos son obligatorios');
        return;
    }

    const inicio = fecha + ' ' + horaInicio;
    const fin = fecha + ' ' + horaFin;

    const ahora = new Date();
    const fechaHoraSeleccionada = new Date(inicio);

    if (fechaHoraSeleccionada.toDateString() === ahora.toDateString()) {

    if (fechaHoraSeleccionada < ahora) {
        mostrarToast('No puedes agendar una hora que ya pasó', 'danger');
        return;
}

    }

    //  URL GENERADA POR LARAVEL
    const url = citaId
        ? "{{ url('admin/agenda') }}/" + citaId + "/update"
        : "{{ route('admin.agenda.store') }}";

    const formData = new FormData();
    formData.append('inicio', inicio);
    formData.append('fin', fin);
    formData.append('paciente_id', paciente);
    formData.append('dentista_id', dentista);
    formData.append('procedimiento', document.getElementById('procedimiento').value);
    formData.append('estado', document.getElementById('estado').value);

    fetch(url, {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute('content')
        },
        body: formData
    })
    .then(async res => {

    const data = await res.json();

    if (!res.ok) {
        mostrarToast(data.message, 'warning');
        return;
    }

    return data;
})
    .then(data => {

        if (!data) return;

        if (citaId) {
            const event = calendar.getEventById(citaId);
            event.setProp('title', data.title);
            event.setStart(data.start);
            event.setEnd(data.end);
            event.setExtendedProp('paciente_id', data.extendedProps.paciente_id);
            event.setExtendedProp('dentista_id', data.extendedProps.dentista_id);
            event.setExtendedProp('procedimiento', data.extendedProps.procedimiento);
            mostrarToast('Cita actualizada correctamente');
        } else {
            calendar.addEvent(data);
            mostrarToast('Cita creada correctamente');
        }

        $('#modalCita').modal('hide');
        document.getElementById('formCita').reset();
        document.getElementById('cita_id').value = '';
    })
    .catch(err => {
        alert(err.message);
    });
    
});
</script>

@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const btnEliminar = document.getElementById('btnEliminar');

    if (!btnEliminar) return;

    btnEliminar.addEventListener('click', function () {

        const citaId = document.getElementById('cita_id').value;
        if (!citaId) return;

        if (!confirm('¿Deseas eliminar esta cita?')) return;

        const formData = new FormData();
        formData.append('_method', 'DELETE');

        fetch(`{{ url('/admin/agenda') }}/${citaId}`, {
            method: 'POST',
            credentials: 'same-origin',
            headers: {
                'X-CSRF-TOKEN': document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute('content'),
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(res => {
            if (!res.ok) throw new Error('Error al eliminar');
            return res.json();
        })
        .then(() => {

            const event = calendar.getEventById(citaId);
            if (event) event.remove();

            $('#modalCita').modal('hide');
            document.getElementById('formCita').reset();
            document.getElementById('cita_id').value = '';

            mostrarToast('Cita eliminada exitosamente');
        })
        .catch(err => {                             
            console.error(err);
            alert('Error al eliminar la cita');
        });

    });

});
</script>
@endpush
