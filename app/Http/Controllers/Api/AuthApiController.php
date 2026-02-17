<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthApiController extends Controller
{
    /**
     * Servicio web para registrar un usuario.
     * Recibe nombre, email y password.
     * Devuelve respuesta en formato JSON.
     */
    public function register(Request $request)
    {
        // Validar datos
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        // Crear usuario
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        // Retornar respuesta JSON
        return response()->json([
            'message' => 'Usuario registrado correctamente',
            'user' => $user
        ], 201);
    }

    /**
     * Servicio web para inicio de sesión.
     * Recibe email y password.
     * Devuelve mensaje de autenticación satisfactoria
     * o error si las credenciales son incorrectas.
     */
    public function login(Request $request)
    {
        // Intentar autenticación
        if (!Auth::attempt($request->only('email', 'password'))) {

            return response()->json([
                'message' => 'Error en la autenticación'
            ], 401);
        }

        return response()->json([
            'message' => 'Autenticación satisfactoria'
        ], 200);
    }
}
