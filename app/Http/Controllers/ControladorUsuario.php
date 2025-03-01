<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControladorUsuario extends Controller
{
    public function user_graficas(){

        return view('user_graficas');
    }
}
