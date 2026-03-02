<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\DentistaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HistoriaClinicaController;
use App\Http\Controllers\ReporteController;


//Route::get('/inicio', function () {
//    return view('welcome'); // vista pública
//})->name('home.public');

Route::get('/', function () {
    return view('index'); // Medilab (página pública)
})->name('public.home');


Auth::routes();

Route::post('/logout', function (Request $request) {
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('public.home');
})->name('logout');

// privado
Route::get('/home', [HomeController::class, 'index'])
    ->middleware('auth')
    ->name('home');

//rutas para el administrador
Route::middleware(['auth', 'role:admin'])->group(function () {

Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');
//rutas para el admin-usuarios
Route::get('/admin/usuarios', [App\Http\Controllers\UsuarioController::class, 'index'])->name('admin.usuarios.index');
//rutas para el admin-usuarios crear
Route::get('/admin/usuarios/create', [App\Http\Controllers\UsuarioController::class, 'create'])->name('admin.usuarios.create');
//rutas para el admin-usuarios guardar
Route::post('/admin/usuarios/create', [App\Http\Controllers\UsuarioController::class, 'store'])->name('admin.usuarios.store');
//rutas para identificador
route::get('/admin/usuarios/{id}', [App\Http\Controllers\UsuarioController::class, 'show'])->name('admin.usuarios.show');
//rutas para editar usuario
route::get('/admin/usuarios/{id}/edit', [App\Http\Controllers\UsuarioController::class, 'edit'])->name('admin.usuarios.edit');
//rutas para actualizar usuario
route::put('/admin/usuarios/{id}', [App\Http\Controllers\UsuarioController::class, 'update'])->name('admin.usuarios.update');
//rutas para eliminar usuario
Route::delete('/admin/usuarios/{id}', [App\Http\Controllers\UsuarioController::class, 'destroy'])
    ->name('admin.usuarios.destroy');
});


//Route::post('/logout', function () {
//Auth::logout();
 //   return redirect('/')
//})->name('logout');

//rutas para el admin-secretarias
Route::middleware(['auth', 'role:admin|secretaria'])->group(function () {

Route::get('/admin/secretarias', [App\Http\Controllers\SecretariaController::class, 'index'])->name('admin.secretarias.index');
//rutas para el admin-secretarias crear 
Route::get('/admin/secretarias/create', [App\Http\Controllers\SecretariaController::class, 'create'])->name('admin.secretarias.create');
//rutas para el admin-secretarias guardar
Route::post('/admin/secretarias/create', [App\Http\Controllers\SecretariaController::class, 'store'])->name('admin.secretarias.store');
//rutas para eliminar secretaria
Route::delete('/admin/secretarias/{secretaria}', [App\Http\Controllers\SecretariaController::class, 'destroy'])->name('admin.secretarias.destroy');
//rutas para ver secretaria
Route::get('/admin/secretarias/{secretaria}', [App\Http\Controllers\SecretariaController::class, 'show'])->name('admin.secretarias.show');
//rutas para editar secretaria
Route::get('/admin/secretarias/{secretaria}/edit', [App\Http\Controllers\SecretariaController::class, 'edit'])->name('admin.secretarias.edit');
//rutas para actualizar secretaria
Route::put('/admin/secretarias/{secretaria}', [App\Http\Controllers\SecretariaController::class, 'update'])->name('admin.secretarias.update');
});

//rutas para el admin-pacientes
Route::get('/admin/pacientes', [App\Http\Controllers\PacienteController::class, 'index'])->name('admin.pacientes.index') 
->middleware('auth');
//rutas para el admin-pacientes crear  
Route::get('/admin/pacientes/create', [App\Http\Controllers\PacienteController::class, 'create'])->name('admin.pacientes.create') 
->middleware('auth');
//rutas para el admin-pacientes guardar
Route::post('/admin/pacientes/create', [App\Http\Controllers\PacienteController::class, 'store'])->name('admin.pacientes.store') 
->middleware('auth');
//rutas para ver paciente
Route::get('/admin/pacientes/{paciente}', [App\Http\Controllers\PacienteController::class, 'show'])->name('admin.pacientes.show')
->middleware('auth');
//rutas para editar paciente
Route::get('/admin/pacientes/{paciente}/edit', [App\Http\Controllers\PacienteController::class, 'edit'])->name('admin.pacientes.edit')
->middleware('auth');
//rutas para actualizar paciente
Route::put('/admin/pacientes/{paciente}', [App\Http\Controllers\PacienteController::class, 'update'])->name('admin.pacientes.update')
->middleware('auth');
//rutas para eliminar paciente
Route::delete('/admin/pacientes/{paciente}', [App\Http\Controllers\PacienteController::class, 'destroy'])->name('admin.pacientes.destroy')
->middleware('auth');   

//rutas para el admin-consultorios
Route::get('/admin/consultorios', [App\Http\Controllers\ConsultorioController::class, 'index'])->name('admin.consultorios.index') 
->middleware('auth');
//rutas para el admin-consultorios crear  
Route::get('/admin/consultorios/create', [App\Http\Controllers\ConsultorioController::class, 'create'])->name('admin.consultorios.create') 
->middleware('auth');
//rutas para el admin-consultorios guardar
Route::post('/admin/consultorios/create', [App\Http\Controllers\ConsultorioController::class, 'store'])->name('admin.consultorios.store') 
->middleware('auth');
//rutas para ver consultorio
Route::get('/admin/consultorios/{consultorio}', [App\Http\Controllers\ConsultorioController::class, 'show'])->name('admin.consultorios.show')
->middleware('auth');
//rutas para editar consultorio
Route::get('/admin/consultorios/{consultorio}/edit', [App\Http\Controllers\ConsultorioController::class, 'edit'])->name('admin.consultorios.edit')
->middleware('auth');
//rutas para actualizar consultorio
Route::put('/admin/consultorios/{consultorio}', [App\Http\Controllers\ConsultorioController::class, 'update'])->name('admin.consultorios.update')
->middleware('auth');
//rutas para eliminar consultorio
Route::delete('/admin/consultorios/{consultorio}', [App\Http\Controllers\ConsultorioController::class, 'destroy'])->name('admin.consultorios.destroy')
->middleware('auth');

//rutas para el admin-dentistas
Route::get('/admin/dentistas', [App\Http\Controllers\DentistaController::class, 'index'])->name('admin.dentistas.index') 
->middleware('auth');
//rutas para el admin-dentistas crear  
Route::get('/admin/dentistas/create', [App\Http\Controllers\DentistaController::class, 'create'])->name('admin.dentistas.create') 
->middleware('auth');
//rutas para el admin-dentistas guardar
Route::post('/admin/dentistas/create', [App\Http\Controllers\DentistaController::class, 'store'])->name('admin.dentistas.store') 
->middleware('auth');
//rutas para ver dentista
Route::get('/admin/dentistas/{dentista}', [App\Http\Controllers\DentistaController::class, 'show'])->name('admin.dentistas.show')
->middleware('auth');
//rutas para editar dentista
Route::get('/admin/dentistas/{dentista}/edit', [App\Http\Controllers\DentistaController::class, 'edit'])->name('admin.dentistas.edit')
->middleware('auth');
//rutas para actualizar dentista
Route::put('/admin/dentistas/{dentista}', [App\Http\Controllers\DentistaController::class, 'update'])->name('admin.dentistas.update')
->middleware('auth');
Route::delete('/admin/dentistas/{dentista}', [App\Http\Controllers\DentistaController::class, 'destroy'])->name('admin.dentistas.destroy')
->middleware('auth');


// ruta ajax para obtener consultorios disponibles
Route::get('/admin/horarios/consultorio/{consultorio}', [App\Http\Controllers\HorarioController::class, 'horariosPorConsultorio'])
    ->name('admin.horarios.consultorio')
    ->middleware('auth');
//rutas para el admin-horarios
Route::get('/admin/horarios', [App\Http\Controllers\HorarioController::class, 'index'])->name('admin.horarios.index') 
->middleware('auth');
//rutas para el admin-horarios crear  
Route::get('/admin/horarios/create', [App\Http\Controllers\HorarioController::class, 'create'])->name('admin.horarios.create') 
->middleware('auth');
//rutas para el admin-horarios guardar
Route::post('/admin/horarios/store', [App\Http\Controllers\HorarioController::class, 'store'])->name('admin.horarios.store') 
->middleware('auth');
//rutas para ver horario
Route::get('/admin/horarios/{horario}', [App\Http\Controllers\HorarioController ::class, 'show'])->name('admin.horarios.show')
->middleware('auth');
//rutas para editar horario
Route::get('/admin/horarios/{horario}/edit', [App\Http\Controllers\HorarioController ::class, 'edit'])->name('admin.horarios.edit')
->middleware('auth');
//rutas para actualizar horario
Route::put('/admin/horarios/{horario}', [App\Http\Controllers\HorarioController ::class, 'update'])->name('admin.horarios.update')
->middleware('auth');
//rutas para eliminar horario
Route::delete('/admin/horarios/{horario}', [App\Http\Controllers\HorarioController ::class, 'destroy'])->name('admin.horarios.destroy')
->middleware('auth');

//rutas para el admin-agenda
Route::middleware(['auth', 'role:admin|secretaria|dentista'])->group(function () {

    Route::get('/admin/agenda', [AgendaController::class, 'index'])
        ->name('admin.agenda');

    Route::post('/admin/agenda', [AgendaController::class, 'store'])
        ->name('admin.agenda.store');

    Route::post('/admin/agenda/{id}/update', [AgendaController::class, 'update'])
    ->name('admin.agenda.update');

    Route::delete('/admin/agenda/{id}', [AgendaController::class, 'destroy'])
        ->name('admin.agenda.destroy');
});

Route::get('/admin', [AdminController::class, 'index'])
    ->middleware(['auth'])
    ->name('admin.index');

Route::middleware(['auth', 'role:usuario'])->group(function () {
    Route::get('/usuario', function () {
        return view('usuario.index');
    })->name('usuario.index');
});

Route::get('/dentista/agenda', [DentistaController::class, 'agenda'])
    ->name('agenda.dentista')
    ->middleware(['auth', 'role:dentista']);

Route::get('/historia/{paciente}', [HistoriaClinicaController::class, 'show'])
    ->name('historia.show');

Route::put('/historia/{id}', [HistoriaClinicaController::class, 'update'])
    ->name('historia.update');

Route::patch('/citas/{id}/realizada',
    [AgendaController::class, 'marcarRealizada'])
    ->name('citas.marcarRealizada');

Route::patch('/citas/{id}/deshacer',
    [AgendaController::class, 'desmarcarRealizada'])
    ->name('citas.desmarcarRealizada');

Route::get('/reportes/citas', [ReporteController::class, 'citas'])->name('reportes.citas');

Route::get('/reportes/citas/excel', [ReporteController::class, 'exportarExcel'])
    ->name('reportes.citas.excel');

Route::get('/reportes/productividad', [ReporteController::class, 'productividad'])
    ->name('reportes.productividad');

Route::get('/reportes/productividad/excel', [ReporteController::class, 'exportarProductividadExcel'])
    ->name('reportes.productividad.excel');

Route::get('reportes', [ReporteController::class, 'index'])
    ->name('reportes')
    ->middleware(['auth']);