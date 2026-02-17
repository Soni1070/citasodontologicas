@extends('layouts.admin')
@section('content')
<div class="row">
    <h1>Listado de Especialistas</h1>
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
                <h3 class="card-title">Dentistas</h3>

                <div class="card-tools">
                  <a href="{{ url('/admin/dentistas/create') }}" class="btn btn-primary">
                    Nuevo dentista
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
     <td style="text-align: center;"><b>Nombre Completo</b></td>   
     <td style="text-align: center;"><b>Registro Médico</b></td>
     <td style="text-align: center;"><b>Especialidad</b></td>
     <td style="text-align: center;"><b>Teléfono</b></td>
     <td style="text-align: center;"><b>Estado</b></td>
     <td style= "text-align: center;"><b>Email</b></td>
          <td style="text-align: center;"><b>Acciones</b></td>
     </tr>
  </thead>
  
  <tbody>
    <?php $contador=1; ?>
    @foreach ($dentistas as $dentista)
    <tr>
        <td style="text-align: center;">{{ $contador++ }}</td>
        <td>{{ $dentista->nombres }} {{ $dentista->apellidos }}</td>
        <td>{{ $dentista->registro_medico }}</td>
        <td>{{ $dentista->especialidad }}</td>
        <td>{{ $dentista->telefono }}</td>
        <td>{{ $dentista->estado }}</td>
        <td>{{ $dentista->user->email }}</td>
        <td style="text-align: center;"> 
            <div class="btn-group" role="group" aria-label="Basic example">
                <a href="{{ url('/admin/dentistas/' . $dentista->id) }}" type="button" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>
                <a href="{{ url('/admin/dentistas/' . $dentista->id . '/edit') }}" type="button" class="btn btn-success btn-sm"><i class="bi bi-pencil"></i></a>
                <form action="{{ route('admin.dentistas.destroy', $dentista->id) }}"
                     method="POST" style="display:inline-block;"
                    onsubmit="return confirm('¿Seguro que deseas eliminar este dentista?');">
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
<!-- Page specific script -->
<script>
                        $(function () {
                            $("#example1").DataTable({
                                "pageLength": 10,
                                "language": {
                                    "emptyTable": "No hay información",
                                    "info": "Mostrando START a END de TOTAL Dentistas",
                                    "infoEmpty": "Mostrando 0 a 0 de 0 Dentistas",
                                    "infoFiltered": "(Filtrado de MAX total Dentistas)",
                                    "infoPostFix": "",
                                    "thousands": ",",
                                    "lengthMenu": "Mostrar _MENU_ Dentistas",
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