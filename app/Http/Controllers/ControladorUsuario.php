<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControladorUsuario extends Controller
{
    public function user_tabla()
    {
        return view('user_tabla'); // Asegúrate de que esta vista exista en resources/views
    }

    public function user_graficas()
    {
        return view('user_graficas'); // Asegúrate de que esta vista exista en resources/views
    }


    public function medico()
    {
        return view('medico'); // Asegúrate de que esta vista exista en resources/views
    }
}
