<?php

namespace App\Http\Controllers;

use App\Models\Secretaria;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class SecretariaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $secretarias = Secretaria::with('user')->get();
        return view('admin.secretarias.index', compact('secretarias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.secretarias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$datos = request()->all();
        //return response()->json($datos)


        $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'documento' => 'required|string|max:50|unique:secretarias,documento',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'fecha_nacimiento' => 'required|date',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        //Log::info('REQUEST SECRETARIA', $request->all());


        DB::transaction(function () use ($request) {

        $usuario = new User();
        $usuario->name = $request->nombres;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->password);
        $usuario->save();

        // ASIGNAR ROL SECRETARIA
        $usuario->assignRole('secretaria');

        //crear secretaria        
        $secretaria = new Secretaria();
        $secretaria->nombres = $request->nombres;
        $secretaria->apellidos = $request->apellidos;
        $secretaria->documento = $request->documento;
        $secretaria->direccion = $request->direccion;
        $secretaria->telefono = $request->telefono;
        $secretaria->fecha_nacimiento = $request->fecha_nacimiento;
        $secretaria->user_id = $usuario->id;
        $secretaria->save();
        });

        return redirect()->route('admin.secretarias.index')
        ->with('success', 'Secretaria creada exitosamente.')
        ->with('icon', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Secretaria $secretaria)
    {
        $secretaria = Secretaria::with('user')->findOrFail($secretaria->id);
        return view('admin.secretarias.show', compact('secretaria'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Secretaria $secretaria)
    {
        $secretaria->load('user');
        return view('admin.secretarias.edit', compact('secretaria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Secretaria $secretaria)
    {

        $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'documento' => 'required|string|max:50|unique:secretarias,documento,'.$secretaria->id,
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'fecha_nacimiento' => 'required|date',
            'email' => 'required|email|max:255|unique:users,email,'.$secretaria->user->id,
            'password' => 'nullable|string|min:8',
        ]);

        $secretaria->update([
        'nombres' => $request->nombres,
        'apellidos' => $request->apellidos,
        'documento' => $request->documento,
        'direccion' => $request->direccion,
        'telefono' => $request->telefono,
        'fecha_nacimiento' => $request->fecha_nacimiento,
        ]);

        $usuario = $secretaria->user;;
        $usuario->name = $request->nombres;
        $usuario->email = $request->email;

        if ($request->filled('password')) {
            $usuario->password = Hash::make($request->password);
        }
        $usuario->save();

        // 🔥 ESTA LÍNEA ES LA CLAVE
        $usuario->assignRole('secretaria');

        return redirect()->route('admin.secretarias.index')
        ->with('success', 'Secretaria actualizada exitosamente.')
        ->with('icon', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Secretaria $secretaria)
{
    DB::transaction(function () use ($secretaria) {

        // eliminar usuario asociado
        if ($secretaria->user) {
            $secretaria->user->delete();
        }

        // eliminar secretaria
        $secretaria->delete();
    });

    return redirect()->route('admin.secretarias.index')
        ->with('success', 'Secretaria eliminada correctamente.')
        ->with('icon', 'success');
}
}
