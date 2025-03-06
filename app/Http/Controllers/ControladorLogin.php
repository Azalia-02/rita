<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;

class ControladorLogin extends Controller
{
    public function login(){
        return view('login');
    }

    public function login_aceptar(Request $request){
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $response = Http::post('http://localhost:3000/api/redirige/', [
        'email' => $request->email,
        'password' => $request->password,
    ]);

    if ($response->successful()) {
        $user = $response->json();

        if ($user && isset($user['password'])) {
            $hashedPassword = trim($user['password']);

            $isPasswordValid = password_verify($request->password, $hashedPassword);

            if ($isPasswordValid) {
                if (isset($user['rol'])) {
                    switch ($user['rol']) {
                        case 'admin':
                            return redirect()->route('panel_admin')->with('success', 'Has iniciado sesión como administrador.');
                        case 'user':
                            return redirect()->route('home_user')->with('success', 'Has iniciado sesión como usuario.');
                        default:
                            return redirect()->route('login')->withErrors('Rol no válido.');
                    }
                } else {
                    return redirect()->route('login')->withErrors('El rol del usuario no está definido.');
                }
            } else {
                return redirect()->route('login')->withErrors('Correo o contraseña incorrectos.');
            }
        } else {
            return redirect()->route('login')->withErrors('Correo o contraseña incorrectos.');
        }
    } else {
        return redirect()->route('login')->withErrors('Error al comunicarse con el servidor.');
    }
  }

    public function login_alta(){
        return view("login_alta");
    }

    public function login_registrar(Request $request){

        $request->validate([
        'nombre' => 'required|string|max:255',
        'app' => 'required|string|max:255',
        'apm' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:tb_login',
        'password' => [
            'required',
            'string',
            'min:8',
            'confirmed',
            'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
        ],
        'rol' => 'required|string|in:admin,user',
    ], [
        'nombre.required' => 'El campo nombre es obligatorio',
        'app.required' => 'El campo apellido paterno es obligatorio',
        'apm.required' => 'El campo apellido materno es obligatorio',
        'email.required' => 'El campo correo electrónico es obligatorio',
        'email.email' => 'El correo electrónico no es válido',
        'email.unique' => 'Este correo electrónico ya está registrado',
        'password.required' => 'El campo contraseña es obligatorio',
        'password.min' => 'La contraseña debe tener al menos 8 caracteres',
        'password.confirmed' => 'Las contraseñas no coinciden',
        'password.regex' => 'La contraseña debe tener al menos una mayúscula, una minúscula, un número y un carácter especial',
        'rol.in' => 'El rol no es válido. Debe ser "admin" o "user".',
    ]);

    $response = Http::post('http://localhost:3000/api/registros/', [
        'nombre' => $request->input('nombre'),
        'app' => $request->input('app'),
        'apm' => $request->input('apm'),
        'email' => $request->input('email'),
        'password' => $request->input('password'),
        'rol' => $request->input('rol'),
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    if ($response->successful()) {
        $user = Http::get('http://localhost:3000/api/redirige/', [
            'email' => $request->email,
        ])->json();
    
        if ($user && isset($user['password']) && Hash::check($request->password, trim($user['password']))) {
            dd($request->password, $user['password']);
            
            if (Hash::check($request->password, $user['password'])) {
                
                Auth::loginUsingId($user['id_login']);
                if (Auth::check()) {
                    if (isset($user['rol'])) {
                        if ($user['rol'] == 'admin') {
                            return redirect()->route('panel_admin')->with('success', 'Has iniciado sesión como administrador.');
                        } else {
                            return redirect()->route('home_user')->with('success', 'Has iniciado sesión como usuario.');
                        }
                    } else {
                        return redirect()->route('login')->withErrors('El rol del usuario no está definido.');
                    }
                } else {
                    return redirect()->route('login')->withErrors('No se pudo autenticar al usuario.');
                }
            } else {
                return redirect()->route('login')->withErrors('Correo o contraseña incorrectos.');
            }
        } else {
            return redirect()->route('login')->withErrors('Correo o contraseña incorrectos.');
        }
    }
  }  
           

    public function logout(Request $request){
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

