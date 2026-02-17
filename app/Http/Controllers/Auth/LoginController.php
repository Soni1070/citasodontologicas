<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Redirección única después del login
     */
    //protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated($request, $user)
{
    if ($user->hasRole('admin')) {
        return redirect()->route('admin.index');
    }

    if ($user->hasRole('secretaria')) {
        return redirect()->route('admin.index');
    }

    if ($user->hasRole('dentista')) {
        return redirect()->route('admin.agenda');
    }

    if ($user->hasRole('usuario')) {
        return redirect()->route('usuario.index');
    }

    // respaldo de seguridad
    Auth::logout();
    return redirect('/login');
}


}