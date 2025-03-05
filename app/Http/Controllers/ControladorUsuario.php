<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControladorUsuario extends Controller
{
    public function home_user(){

        return view('home_user');
    }
}
