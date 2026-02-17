<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use App\Models\Dentista;
use App\Models\Secretaria;
use App\Models\Paciente;
use App\Models\Consultorio;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
   public function index()
{
    $user = auth()->user();

    // ADMIN
    if ($user->hasRole('admin')) {
        return redirect()->route('admin.index');
    }

    // SECRETARIA
    if ($user->hasRole('secretaria')) {
        return redirect()->route('admin.secretarias.index');
    }

    // DENTISTA
    if ($user->hasRole('dentista')) {
        return redirect()->route('admin.dentistas.index');
    }

    // USUARIO NORMAL
    if ($user->hasRole('usuario')) {
        return redirect()->route('admin.agenda');
        // ← usa una ruta QUE YA EXISTE
    }

    abort(403, 'Tu usuario no tiene un rol asignado correctamente HomeController.');
}

}