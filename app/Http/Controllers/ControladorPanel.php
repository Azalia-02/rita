<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControladorPanel extends Controller
{
    public function panel_admin(){

        $paciente = $request->input('paciente');
        return view('panel_admin', compact('paciente'));
    }
}
