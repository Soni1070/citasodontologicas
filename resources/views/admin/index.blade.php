@extends('layouts.admin')
@section('content')
<div class="row">
    <h1>
    Bienvenido: {{ Auth::user()->email }} / 
    Función: {{ Auth::user()->getRoleNames()->first() ?? 'Sin rol asignado' }}
</h1>
</div>

<div class="row">
  @can('ver usuarios')
  <!-- small box -->
            <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $total_usuarios }}</h3>
                <p>Usuarios</p>
              </div>
              <div class="icon">
                <i class="nav-icon fas bi bi-person-circle"></i>
              </div>
              <a href="{{ url('/admin/usuarios') }}" class="small-box-footer">Mas información <i class="bi bi-file-person"></i></a>
            </div>
          </div>
  @endcan
    
            @can ('ver secretarias')       
            <!-- small box -->
            <div class="col-lg-3 col-6">
            <div class="small-box bg-primary">
              <div class="inner">
                <h3>{{ $total_secretarias }}</h3>
                <p>Secretarias</p>
              </div>
              <div class="icon">
                <i class="nav-icon  fas bi bi-person-badge"></i>
              </div>
              <a href="{{ url('/admin/secretarias') }}" class="small-box-footer">Mas información <i class="bi bi-file-person"></i></a>
            </div>
          </div>
          @endcan

          
          @can ('ver pacientes')
          <!-- small box -->
            <div class="col-lg-3 col-6"> 
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $total_pacientes }}</h3>
                <p>Pacientes</p>
              </div>
              <div class="icon">
                <i class="nav-icon fas bi bi-person-fill-check"></i>
              </div>
              <a href="{{ url('/admin/pacientes') }}" class="small-box-footer">Mas información <i class="bi bi-file-person"></i></a>
            </div>
          </div>
          @endcan

          @can ('ver consultorios')
          <!-- small box -->
          <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{ $total_consultorios }}</h3>
                <p>Consultorios</p>
              </div>
              <div class="icon">
                <i class="nav-icon fas bi bi-door-open"></i>  <!-- icono -->
              </div>
              <a href="{{ url('/admin/consultorios') }}" class="small-box-footer">Mas información <i class="bi bi-file-person"></i></a>
            </div>
          </div>
          @endcan

          @can ('ver dentistas')
          <!-- small box -->
          <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{ $total_dentistas }}</h3>
                <p>Dentistas</p>
              </div>
              <div class="icon">
                <i class="nav-icon fas bi bi-journal-medical"></i>  <!-- icono -->
              </div>
              <a href="{{ url('/admin/dentistas') }}" class="small-box-footer">Mas información <i class="bi bi-file-person"></i></a>
            </div>
          </div>
          @endcan

          @can ('ver horarios')
          <!-- small box -->
          <div class="col-lg-3 col-6">
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3>{{ $total_horarios }}</h3>
                <p>Horarios</p>
              </div>
              <div class="icon">
                <i class="nav-icon fas bi bi-calendar2-date"></i>  <!-- icono -->
              </div>
              <a href="{{ url('/admin/horarios') }}" class="small-box-footer">Mas información <i class="bi bi-file-person"></i></a>
            </div>
          </div>
          @endcan

          @role('admin|secretaria')
<div class="col-lg-3 col-6">
  <div class="small-box bg-info">
    <div class="inner">
      <h3>Agenda</h3>
      <p>Agenda general</p>
    </div>
    <div class="icon">
      <i class="bi bi-calendar-event"></i>
    </div>
    <a href="{{ route('admin.agenda') }}" class="small-box-footer">
      Ver agenda <i class="fas fa-arrow-circle-right"></i>
    </a>
  </div>
</div>
@endrole

          </div> <!-- /.row de small-box -->

@endsection
    