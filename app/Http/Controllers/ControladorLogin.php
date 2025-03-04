<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Login;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ControladorLogin extends Controller
{
    public function login(){

	    if (Auth::check()) {
	        return $this->redireccionarPorRol(Auth::user()->rol);
	    }
	    return view('login');
    }

    public function login_aceptar(Request $request){
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();

        if ($user && $user->rol) {
            
            if ($user->rol == 'admin') {
                return redirect()->route('panel_admin')->with('success', 'Has iniciado sesión como administrador.');
            } else {
                return redirect()->route('user_tabla')->with('success', 'Has iniciado sesión como usuario.');
            }
        } else {
            return redirect()->route('login')->withErrors('El usuario no tiene un rol asignado.');
        }
    } else {
        return redirect()->route('login')->withErrors('Correo o contraseña incorrectos.');
    }}
    

    public function login_alta(){
        return view("login_alta");
    }

    public function login_registrar(Request $request){
    $this->validate($request, [
        'nombre' => 'required',
        'app' => 'required',
        'apm' => 'required',
        'email' => 'required|email|unique:tb_login,email',
        'password' => 'required|min:8',
        'rpassword' => 'required|same:password',
        'rol' => 'required|in:usuario,admin',  
    ]);

    $hashedPassword = bcrypt($request->input('password'));

    $user = Login::create([
        'nombre' => $request->input('nombre'),
        'app' => $request->input('app'),
        'apm' => $request->input('apm'),
        'email' => $request->input('email'),
        'password' => $hashedPassword,
        'rol' => $request->input('rol'),
    ]);

    if (!$user) {
        return redirect()->route('login')->withErrors('No se pudo crear el usuario.');
    }
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();

        if ($user && $user->rol) {
            
            if ($user->rol == 'admin') {
                return redirect()->route('panel_admin')->with('success', 'Has iniciado sesión como administrador.');
            } else {
                return redirect()->route('home_user')->with('success', 'Has iniciado sesión como usuario.');
            }
        } else {
            return redirect()->route('login')->withErrors('El usuario no tiene un rol asignado.');
        }
    } else {
        return redirect()->route('login')->withErrors('Correo o contraseña incorrectos.');
    }}

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    private function redireccionarPorRol($role)
    {
        if($role == 'admin'){
            return redirect()->route('panel_admin');
        }
        return redirect()->route('user_tabla');
    }
}
