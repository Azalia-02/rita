<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControladorPanel extends Controller
{
    public function panel_admin(){

        return view('panel_admin');
    }
}
