@extends('layouts.admin')
@section('content')
<div class="row">
    <h1>Listado de Pacientes</h1>
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
                <h3 class="card-title">Pacientes registrados</h3>

                <div class="card-tools">
                  <a href="{{ url('/admin/pacientes/create') }}" class="btn btn-primary">
                    Registrar paciente
                  </a>
                </div>
                <!-- /.card-tools -->
              </div>
  <!-- /.card-header -->
 <div class="card-body">
<div class="table-responsive">
  <table id="example1" class="table table-striped table-bordered table-hover table-sm">
   <thead style="background-color: #AABCEE;">
    <tr>
     <td style="text-align: center;"><b>Registro</b></td>   
     <td style="text-align: center;"><b>Nombres y Apelidos</b></td>
     <td style="text-align: center;"><b>Documento</b></td>
     <td style="text-align: center;"><b>Numero_seguro</b></td>
     <td style="text-align: center;"><b>Fecha_Nacimiento</b></td>
     <td style="text-align: center;"><b>Genero</b></td>
     <td style="text-align: center;"><b>Telefono</b></td>
     <td style="text-align: center;"><b>Direccion</b></td>
     <td style="text-align: center;"><b>RH</b></td>
     <td style="text-align: center;"><b>Alergias</b></td>
     <td style="text-align: center;"><b>Observaciones</b></td>
     <td style="text-align: center;"><b>Acciones</b></td>
     </tr>
  </thead>
  
  <tbody>
    <?php $contador=1; ?>
    @foreach ($pacientes as $paciente)
    <tr>
        <td style="text-align: center;">{{ $contador++ }}</td>
        <td>{{ $paciente->nombres }} {{ $paciente->apellidos }}</td>
        <td>{{ $paciente->documento }}</td>
        <td>{{ $paciente->numero_seguro }}</td>
        <td>{{ $paciente->fecha_nacimiento }}</td>
        <td>{{ $paciente->genero }}</td>
        <td>{{ $paciente->telefono }}</td>
        <td>{{ $paciente->direccion }}</td>
        <td>{{ $paciente->grupo_sanguineo }}</td>
        <td>{{ $paciente->alergias }}</td>
        <td>{{ $paciente->observaciones }}</td>
        <td style="text-align: center;"> 
            <div class="btn-group" role="group" aria-label="Basic example">
                <a href="{{ url('/admin/pacientes/' . $paciente->id) }}" type="button" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>
                <a href="{{ url('/admin/pacientes/' . $paciente->id . '/edit') }}" type="button" class="btn btn-success btn-sm"><i class="bi bi-pencil"></i></a>
                <form action="{{ route('admin.pacientes.destroy', $paciente->id) }}" 
                     method="POST" style="display:inline-block;"
                    onsubmit="return confirm('¿Seguro que deseas eliminar este paciente?');">
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
</div> <!-- table-responsive -->
<!-- Page specific script -->
<script>
                        $(function () {
                            $("#example1").DataTable({
                                "pageLength": 10,
                                "language": {
                                    "emptyTable": "No hay información",
                                    "info": "Mostrando START a END de TOTAL Pacientes",
                                    "infoEmpty": "Mostrando 0 a 0 de 0 Pacientes",
                                    "infoFiltered": "(Filtrado de MAX total Pacientes)",
                                    "infoPostFix": "",
                                    "thousands": ",",
                                    "lengthMenu": "Mostrar _MENU_ Pacientes",
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