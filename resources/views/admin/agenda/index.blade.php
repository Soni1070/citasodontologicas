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
                  {{ $paciente->nombres }}
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
                  {{ $dentista->nombres }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label>Consultorio</label>
            <select id="consultorio_id" class="form-control">
              <option value="">Seleccione</option>
              @foreach($consultorios as $consultorio)
                <option value="{{ $consultorio->id }}">
                  {{ $consultorio->nombre }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label>Procedimiento</label>
            <input type="text" id="procedimiento" class="form-control" required>
          </div>

        </form>
      </div>

      <div class="modal-footer">
        <button type="button" id="btnEliminar" class="btn btn-danger">
        Eliminar
        </button>
        <button class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="guardarCita">
        Guardar
        </button>
      </div>

    </div>
  </div>
</div>

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

    $('#modalCita').modal('show');
},

    eventClick: function(info) {

    const hoy = new Date();
    hoy.setHours(0,0,0,0);

    if (info.event.start < hoy) {
        mostrarToast('No puedes editar una cita pasada', 'warning');
        return;
    }

        abrirModalEditar(info.event);
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

    document.getElementById('paciente_id').value =
    String(event.extendedProps.paciente_id);

document.getElementById('dentista_id').value =
    String(event.extendedProps.dentista_id);

document.getElementById('consultorio_id').value =
    String(event.extendedProps.consultorio_id);

document.getElementById('procedimiento').value =
    event.extendedProps.procedimiento;



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
    const consultorio = document.getElementById('consultorio_id').value;
    const procedimiento = document.getElementById('procedimiento').value;

    if (!fecha || !horaInicio || !horaFin || !paciente || !dentista || !consultorio)  {
        alert('Todos los campos son obligatorios');
        return;
    }

    const inicio = fecha + ' ' + horaInicio;
    const fin = fecha + ' ' + horaFin;

    //  URL GENERADA POR LARAVEL
    const url = citaId
        ? "{{ url('admin/agenda') }}/" + citaId + "/update"
        : "{{ route('admin.agenda.store') }}";

    const formData = new FormData();
    formData.append('inicio', inicio);
    formData.append('fin', fin);
    formData.append('paciente_id', paciente);
    formData.append('dentista_id', dentista);
    formData.append('consultorio_id', consultorio);
    formData.append('procedimiento', document.getElementById('procedimiento').value);

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
        if (!res.ok) {
            const text = await res.text();
            console.error(text);
            throw new Error('Error en servidor');
        }
        return res.json();
    })
    .then(data => {

        if (citaId) {
            const event = calendar.getEventById(citaId);
            event.setProp('title', data.title);
            event.setStart(data.start);
            event.setEnd(data.end);
            event.setExtendedProp('paciente_id', data.extendedProps.paciente_id);
            event.setExtendedProp('dentista_id', data.extendedProps.dentista_id);
            event.setExtendedProp('consultorio_id', data.extendedProps.consultorio_id);
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
document.getElementById('btnEliminar').addEventListener('click', function () {

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
</script>
@endpush
