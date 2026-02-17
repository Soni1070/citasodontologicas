<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="es">
<head>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <meta http-equiv="x-ua-compatible" content="ie=edge">
 <meta name="csrf-token" content="{{ csrf_token() }}">

 <title>Sistema de gestión de citas odontológicas</title>

<!-- Font Awesome Icons -->
 <link rel="stylesheet" href="{{url('plugins/fontawesome-free/css/all.min.css')}}">
<!-- Theme style -->
 <link rel="stylesheet" href="{{url('dist/css/adminlte.min.css')}}">

 <!-- FullCalendar -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/main.min.css" rel="stylesheet">

<!-- Google Font: Source Sans Pro -->
 <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<!--iconos de bootstrap-->
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

 <!-- DataTables -->
 <link rel="stylesheet" href="{{url('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}} ">
 <link rel="stylesheet" href=" {{url('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}} ">
 <link rel="stylesheet" href="{{url('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}} ">

 <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('/admin') }}" class="nav-link">Sistema de gestión de citas odontológicas</a>
      </li>
    </ul>

        <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <!-- Notifications Dropdown Menu -->
      
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i
            class="fas fa-th-large"></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
      <img src="{{url('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Citas odontológicas</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

@php
    $inicio = '/';

    if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('secretaria')) {
        $inicio = route('admin.index');
    } elseif (Auth::user()->hasRole('dentista')) {
        $inicio = route('admin.agenda');
    } elseif (Auth::user()->hasRole('usuario')) {
        $inicio = route('usuario.index');
    }
@endphp

<a href="{{ $inicio }}" class="btn btn-secondary mb-1 nav-link active">
    <i class="nav-icon fas fa-home"></i>
    <p>Inicio</p>
</a>

             
              {{-- AGENDA ADMIN / SECRETARIA--}}
@role('admin|secretaria')
<li class="nav-item">
    <a href="{{ route('admin.agenda') }}" class="nav-link active">
        <i class="nav-icon bi bi-calendar-event"></i>
        <p>Agenda general</p>
    </a>
</li>
@endrole

{{-- AGENDA DENTISTA --}}
@role('dentista')
<li class="nav-item">
    <a href="{{ route('admin.agenda') }}" class="nav-link active">
        <i class="nav-icon bi bi-calendar-event"></i>
        <p>Mi agenda</p>
    </a>
</li>
@endrole


            @can('ver usuarios')
               <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas bi bi-person-circle"></i>
              <p>
                Usuarios
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              @can('crear usuarios')
              <li class="nav-item">
                <a href="{{ url('/admin/usuarios/create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Creación de usuarios</p>
                </a>
              </li>
              @endcan

              <li class="nav-item">
                <a href="{{ url('/admin/usuarios') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Listado de usuarios</p>
                </a>
              </li>
            </ul>
          </li>
          @endcan
          
@role('admin')
<li class="nav-item">
  <a href="#" class="nav-link active">
    <i class="nav-icon bi bi-person-badge"></i>
    <p>
      Secretarias
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>

  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{ url('/admin/secretarias/create') }}" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>Registrar secretaria</p>
      </a>
    </li>

    <li class="nav-item">
      <a href="{{ url('/admin/secretarias') }}" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>Listado de secretarias</p>
      </a>
    </li>
  </ul>
</li>
@endrole

@role('admin|secretaria')
<li class="nav-item">
  <a href="#" class="nav-link active">
    <i class="nav-icon bi bi-person-fill-check"></i>
    <p>
      Pacientes
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>

  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{ url('/admin/pacientes/create') }}" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>Registrar paciente</p>
      </a>
    </li>

    <li class="nav-item">
      <a href="{{ url('/admin/pacientes') }}" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>Listado de pacientes</p>
      </a>
    </li>
  </ul>
</li>
@endrole

@role('admin|secretaria')
<li class="nav-item">
  <a href="#" class="nav-link active">
    <i class="nav-icon bi bi-door-open"></i>
    <p>
      Consultorios
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>

  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{ url('/admin/consultorios/create') }}" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>Registrar consultorio</p>
      </a>
    </li>

    <li class="nav-item">
      <a href="{{ url('/admin/consultorios') }}" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>Listado de consultorios</p>
      </a>
    </li>
  </ul>
</li>
@endrole

@role('admin')
<li class="nav-item">
  <a href="#" class="nav-link active">
    <i class="nav-icon bi bi-journal-medical"></i>
    <p>
      Dentistas
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>

  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{ url('/admin/dentistas/create') }}" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>Registrar Dentista</p>
      </a>
    </li>

    <li class="nav-item">
      <a href="{{ url('/admin/dentistas') }}" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>Listado de Dentistas</p>
      </a>
    </li>
  </ul>
</li>
@endrole

@role('admin|secretaria')
<li class="nav-item">
  <a href="#" class="nav-link active">
    <i class="nav-icon bi bi-calendar2-date"></i>
    <p>
      Horarios
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>

  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{ url('/admin/horarios/create') }}" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>Registrar Horario</p>
      </a>
    </li>

    <li class="nav-item">
      <a href="{{ url('/admin/horarios') }}" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>Listado de Horarios</p>
      </a>
    </li>
  </ul>
</li>
@endrole
          <li class="nav-item">
            <a href="#" class="nav-link" style="background-color:black;"
              onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="nav-icon fas bi bi-door-closed-fill"></i>
              <p>             
                 Cerrar sesión
              </p>
            </a>
          </li>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
          </form>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
            @if (session('success') && session('icon') == 'success')
              <script>
                  Swal.fire({
                  position: "top-end",
                  icon: "{{ session('icon') }}",
                  title: "{{ session('success') }}",
                  showConfirmButton: false,
                   timer: 4500
                  });
              </script>
              @endif

<div class="content-wrapper">
    <section class="content pt-3">
        <div class="container-fluid">
            @yield('content')
        </div>
    </section>
</div>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      By Sonia Arcila Rodriguez
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery (SIEMPRE PRIMERO) -->
<script src="{{ url('plugins/jquery/jquery.min.js') }}"></script>

<!-- Bootstrap -->
<script src="{{ url('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- AdminLTE -->
<script src="{{ url('dist/js/adminlte.min.js') }}"></script>

<!-- DataTables -->
<script src="{{ url('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ url('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ url('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ url('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ url('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ url('plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ url('plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ url('plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ url('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ url('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ url('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- FullCalendar -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>

<!-- Idioma Español -->
<script src="{{ asset('fullcalendar/es.global.js') }}"></script>

<!-- Scripts específicos por vista -->
@stack('scripts')

</body>
</html>
