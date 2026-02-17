@extends('layouts.admin')
@section('content')
<div class="row">
    <h1>Listado de Secretarias</h1>
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
                <h3 class="card-title">Secretarias registradas</h3>
                <div class="card-tools">
                  <a href="{{ url('/admin/secretarias/create') }}" class="btn btn-primary">
                    Registrar nuevo
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
     <td style="text-align: center;"><b>Nombres</b></td>
     <td style="text-align: center;"><b>Apellidos</b></td>
     <td style="text-align: center;"><b>Documento</b></td>
     <td style="text-align: center;"><b>Telefono</b></td>
     <td style="text-align: center;"><b>Dirección</b></td>
     <td style="text-align: center;"><b>Fecha de nacimiento</b></td>
     <td style="text-align: center;"><b>Email</b></td>
     <td style="text-align: center;"><b>Acciones</b></td>
     </tr>
  </thead>
  
  <tbody>
    <?php $contador=1; ?>
    @foreach ($secretarias as $secretaria)
    <tr>
        <td style="text-align: center;">{{ $contador++ }}</td>
        <td>{{ $secretaria->nombres }}</td>
        <td>{{ $secretaria->apellidos }}</td>
        <td>{{ $secretaria->documento }}</td>
        <td>{{ $secretaria->telefono }}</td>
        <td>{{ $secretaria->direccion }}</td>
        <td>{{ $secretaria->fecha_nacimiento }}</td>
        <td>{{ $secretaria->user->email }}</td>
        <td style="text-align: center;"> 
            <div class="btn-group" role="group" aria-label="Basic example">
                <a href="{{ url('/admin/secretarias/' . $secretaria->id) }}" type="button" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>
                <a href="{{ route('admin.secretarias.edit', $secretaria->id) }}" type="button" class="btn btn-success btn-sm"><i class="bi bi-pencil"></i></a>
                <form action="{{ route('admin.secretarias.destroy', $secretaria->id) }}" 
                     method="POST" style="display:inline-block;"
                    onsubmit="return confirm('¿Seguro que deseas eliminar esta secretaria y su usuario?');">
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
                                    "info": "Mostrando START a END de TOTAL Secretarias",
                                    "infoEmpty": "Mostrando 0 a 0 de 0 Secretarias",
                                    "infoFiltered": "(Filtrado de MAX total Secretarias)",
                                    "infoPostFix": "",
                                    "thousands": ",",
                                    "lengthMenu": "Mostrar _MENU_Secretarias",
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