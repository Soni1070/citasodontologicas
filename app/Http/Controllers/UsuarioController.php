<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsuarioController extends Controller
{
    public function index()
    
    {
        $usuarios = User::all();
        return view('admin.usuarios.index', compact('usuarios'));
    }

    public function create() 
    {
        return view('admin.usuarios.create');
    }

     public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'role' => 'required|exists:roles,name',
    ]);

    $usuario = new User();
    $usuario->name = $request->name;
    $usuario->email = $request->email;
    $usuario->password = Hash::make($request->password);
    $usuario->save();

    // ASIGNAR ROL (obligatorio y único)
    $usuario->syncRoles([$request->role]);

    if ($request->role === 'secretaria') {
    Secretaria::create([
        'user_id' => $usuario->id,
    ]);
}

if ($request->role === 'dentista') {
    Dentista::create([
        'user_id' => $usuario->id,
    ]);
}

    return redirect()->route('admin.usuarios.index')
        ->with('success', 'Usuario creado exitosamente.')
        ->with('icon', 'success');
} 

    public function show($id)
    {
        $usuario = User::findOrFail($id);
        return view('admin.usuarios.show', compact('usuario'));
    } 
    
    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        return view('admin.usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, $id)
{
    $usuario = User::findOrFail($id);

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $usuario->id,
    ]);

    $usuario->name = $request->name;
    $usuario->email = $request->email;
    $usuario->save();

    return redirect()->route('admin.usuarios.index')
    ->with('success', 'Usuario actualizado correctamente.');
}

    public function destroy($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->delete();

        return redirect()->route('admin.usuarios.index')
            ->with('success', 'Usuario eliminado correctamente.');
    }

}
