<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ControladorUsuario extends Controller
{
    public function home_user(){

        return view('home_user');
    }

    public function home(){

        return view('home');
    }

    public function nosotros(){

        return view('nosotros');
    }

    public function productosu(Request $request)
    {
        $response = Http::get('http://3.83.41.64:3003/api/productos/');

        if ($response->successful()) {
            $data = $response->json();
            return view('productosu', compact('data'));
        } else {
            return response()->json(['error' => 'Error al consultar la API'], 500);
        }
    }
        
}
