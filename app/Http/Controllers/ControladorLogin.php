<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Login;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ControladorLogin extends Controller
{
    public function login(){

        // Comprobamos si el usuario ya está autenticado
	    if (Auth::check()) {
	
	        // Si está logado le mostramos la vista de logados
	        return $this->redireccionarPorRol(Auth::user()->rol);
	    }
	
	    // Si no está logado le mostramos la vista con el formulario de login
	    return view('login');
    }

    public function login_aceptar(Request $request)
{
    // Validación de las credenciales
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Obtener las credenciales
    $credentials = $request->only('email', 'password');

    // Intentar autenticar al usuario
    if (Auth::attempt($credentials)) {
        // Si la autenticación fue exitosa, obtén el usuario autenticado
        $user = Auth::user();

        // Verifica si el usuario está autenticado y tiene el rol
        if ($user && $user->rol) {
            // Redirigir según el rol del usuario
            if ($user->rol == 'admin') {
                return redirect()->route('panel_admin')->with('success', 'Has iniciado sesión como administrador.');
            } else {
                return redirect()->route('home_user')->with('success', 'Has iniciado sesión como usuario.');
            }
        } else {
            // Si el rol no está presente o el usuario no tiene rol asignado
            return redirect()->route('login')->withErrors('El usuario no tiene un rol asignado.');
        }
    } else {
        // Si las credenciales no son correctas, mostrar un mensaje de error
        return redirect()->route('login')->withErrors('Correo o contraseña incorrectos.');
    }
}
    

    public function login_alta(){
        return view("login_alta");
    }

    public function login_registrar(Request $request)
{
    // Validaciones
    $this->validate($request, [
        'nombre' => 'required',
        'email' => 'required|email|unique:tb_login,email',
        'password' => 'required|min:8',
        'rpassword' => 'required|same:password',
        'rol' => 'required|in:usuario,admin',  
    ]);

    // Cifrar la contraseña
    $hashedPassword = bcrypt($request->input('password'));

    // Crear el nuevo registro de usuario con la contraseña cifrada
    $user = Login::create([
        'nombre' => $request->input('nombre'),
        'apellido' => $request->input('apellido'),
        'email' => $request->input('email'),
        'password' => $hashedPassword,
        'rol' => $request->input('rol'),  // Asignar el rol
    ]);

    // Verificar que el usuario se haya creado correctamente
    if (!$user) {
        return redirect()->route('login')->withErrors('No se pudo crear el usuario.');
    }

    // Intentar autenticar manualmente usando Auth::attempt
    $credentials = [
        'email' => $user->email,
        'password' => $request->input('password'), // Usar la contraseña en texto plano
    ];

    // Verificar si las credenciales son correctas
    if (Auth::attempt($credentials)) {
        // Depuración para verificar si la autenticación fue exitosa
        //dd('Usuario autenticado correctamente: ', Auth::user()->rol);

        // Redirigir según el rol del usuario
        if (Auth::user()->rol == 'admin') {
            return redirect()->route('panel_admin')->with('success', 'Has iniciado sesión como administrador.');
        } else {
            return redirect()->route('home_user')->with('success', 'Has iniciado sesión como usuario.');
        }
    } else {
        // Si la autenticación falla, mostrar error
        return redirect()->route('login')->withErrors('Correo o contraseña incorrectos.');
    }
}

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
        return redirect()->route('home_user');
    }
}
