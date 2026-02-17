<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $total_usuarios = \App\Models\User::count();
        $total_secretarias = \App\Models\Secretaria::count();
        $total_pacientes = \App\Models\Paciente::count();
        $total_consultorios = \App\Models\Consultorio::count();
        $total_dentistas = \App\Models\Dentista::count();
        $total_horarios = \App\Models\Horario::count();
        return view('admin.index', compact('total_usuarios' ,'total_secretarias', 'total_pacientes', 'total_consultorios', 'total_dentistas', 'total_horarios'));
    }
}
