@extends('layouts.admin')
@section('content')
<div class="row">
    <h1>Listado de Horarios</h1>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif


    <hr>

<div class="row">
    <div class="col-md-12">
            <div class="card card-outline card-primary">
              <div class="card-header">
                <h3 class="card-title">Horarios</h3>

                <div class="card-tools">
                  <a href="{{ url('/admin/horarios/create') }}" class="btn btn-primary">
                    Nuevo horario
                  </a>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">

  <table id="example1" class="table table-striped table-bordered table-hover table-sm">
   <thead style="background-color: #AABCEE;">
    <tr>
     <td style="text-align: center;"><b>Registro</b></td>
     <td style="text-align: center;"><b>Dentista</b></td>   
     <td style="text-align: center;"><b>Especialidad</b></td>
     <td style="text-align: center;"><b>Consultorio</b></td>
     <td style="text-align: center;"><b>Día de atención</b></td>
     <td style="text-align: center;"><b>Hora Inicio</b></td>
     <td style= "text-align: center;"><b>Hora Fin</b></td>
        <td style="text-align: center;"><b>Acciones</b></td>
     </tr>
  </thead>
  
  <tbody>
    <?php $contador=1; ?>
    @foreach ($horarios as $horario)
    <tr>
        <td style="text-align: center;">{{ $contador++ }}</td>
        <td>{{ $horario->dentista->nombres }} {{ $horario->dentista->apellidos }}</td>
        <td>{{ $horario->dentista->especialidad }}</td>
        <td>{{ $horario->consultorio->nombre }} - {{ $horario->consultorio->ubicacion }}</td> 
        <td style="text-align: center;">{{ $horario->dia }}</td>
        <td style="text-align: center;">{{ $horario->hora_inicio }}</td>
        <td style="text-align: center;">{{ $horario->hora_fin }}</td>
        <td style="text-align: center;"> 
            <div class="btn-group" role="group" aria-label="Basic example">
                <a href="{{ url('/admin/horarios/' . $horario->id) }}" type="button" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>
                <a href="{{ url('/admin/horarios/' . $horario->id . '/edit') }}" type="button" class="btn btn-success btn-sm"><i class="bi bi-pencil"></i></a>
                <form action="{{ route('admin.horarios.destroy', $horario->id) }}"
                     method="POST" style="display:inline-block;"
                    onsubmit="return confirm('¿Seguro que deseas eliminar el especialista?');">
                    @csrf
                   @method('DELETE')
                   <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                </form>
            </div>
        </td>
    </tr>
    @endforeach
  </tbody>
</table> 

<hr>
<h4 class="text-center mt-4">Agenda Semanal</h4>

<div class="card mb-4">
    <div class="card-header">
        <strong>Filtrar agenda por consultorio</strong>
    </div>

    <div class="card-body">
        <a href="{{ route('admin.horarios.index') }}"
           class="btn btn-secondary btn-sm">
           Ver todos
        </a>

        @foreach ($consultorios as $consultorio)
            <a href="{{ route('admin.horarios.index', ['consultorio_id' => $consultorio->id]) }}"
               class="btn btn-outline-primary btn-sm">
               {{ $consultorio->nombre }}
            </a>
        @endforeach
    </div>
</div>

<table class="table table-bordered text-center">
    <thead class="table-light">
        <tr>
            <th>Hora</th>
            <th>Lunes</th>
            <th>Martes</th>
            <th>Miercoles</th>
            <th>Jueves</th>
            <th>Viernes</th>
        </tr>
    </thead>
    <tbody>
        @for ($hora = 8; $hora <= 18; $hora++)
        <tr>
            <td>{{ $hora }}:00</td>

            @foreach (['Lunes','Martes','Miercoles','Jueves','Viernes'] as $dia)
                <td>
                    @foreach ($horarios as $horario)

    @php
        $horaInicio = (int) date('H', strtotime($horario->hora_inicio));
        $horaFin = (int) date('H', strtotime($horario->hora_fin));
    @endphp

    @if (
        strtolower($horario->dia) === strtolower($dia) &&
        $hora >= $horaInicio &&
        $hora < $horaFin
    )
        <div class="bg-info text-white p-1 rounded mb-1">
            {{ $horario->dentista->nombres }} {{ $horario->dentista->apellidos }}<br>
            {{ $horario->dentista->especialidad }} <br>
            <small>{{ $horario->consultorio->nombre }}</small>
        </div>
    @endif

@endforeach


                </td>
            @endforeach
        </tr>
        @endfor
    </tbody>
</table>

</div>


<!-- Page specific script -->
<script>
                        $(function () {
                            $("#example1").DataTable({
                                "pageLength": 10,
                                "language": {
                                    "emptyTable": "No hay información",
                                    "info": "Mostrando START a END de TOTAL Horarios",
                                    "infoEmpty": "Mostrando 0 a 0 de 0 Horarios",
                                    "infoFiltered": "(Filtrado de MAX total Horarios)",
                                    "infoPostFix": "",
                                    "thousands": ",",
                                    "lengthMenu": "Mostrar _MENU_ Horarios",
                                    "loadingRecords": "Cargando...",
                                    "processing": "Procesando...",
                                    "search": "Buscador:",
                                    "zeroRecords": "Sin resultados encontrados",
                                    "paginate": {
                                        "first": "Primero",
                                        "last": "Ultimo",
                                        "next": "Siguiente",
                                        "previous": "Anterior"
                                    }
                                },
                                "responsive": true, "lengthChange": true, "autoWidth": false,
                                buttons: [{
                                    extend: 'collection',
                                    text: 'Reportes',
                                    orientation: 'landscape',
                                    buttons: [{
                                        text: 'Copiar',
                                        extend: 'copy',
                                    }, {
                                        extend: 'pdf'
                                    },{
                                        extend: 'csv'
                                    },{
                                        extend: 'excel'
                                    },{
                                        text: 'Imprimir',
                                        extend: 'print'
                                    }
                                    ]
                                },
                                    {
                                        extend: 'colvis',
                                        text: 'Visor de columnas',
                                        collectionLayout: 'fixed three-column'
                                    }
                                ],
                            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                        });
                    </script> 
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>

</div>
@endsection