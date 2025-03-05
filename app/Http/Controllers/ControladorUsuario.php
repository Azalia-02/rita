<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControladorUsuario extends Controller
{
<<<<<<< HEAD
    public function home_user(){

        return view('home_user');
=======
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
>>>>>>> 25327f4e5a27b7a6f5d1f1c0d04ee216cd939f40
    }
}
