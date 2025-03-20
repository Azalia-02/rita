<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class ControladorCitas extends Controller
{
public function citas(Request $request)
{
    $responseCitas = Http::get('http://localhost:3000/api/citas/');
    $responsePacientes = Http::get('http://localhost:3000/api/pacientes/');
    $responseMedicos = Http::get('http://localhost:3000/api/medicos/');

    if ($responseCitas->successful() && $responsePacientes->successful() && $responseMedicos->successful()) {
        $citas = $responseCitas->json();
        $pacientes = $responsePacientes->json()['data'];
        $medicos = $responseMedicos->json()['data'];

        return view('citas', compact('citas', 'pacientes', 'medicos'));
    } else {
        return response()->json(['error' => 'Error al consultar la API'], 500);
    }
}

public function guardar_cita(Request $request)
{
    $request->validate([
        'paciente' => 'required|exists:tb_pacientes,id_paciente',
        'medico' => 'required|exists:tb_medicos,id_medico',
        'fecha' => 'required|date',
        'hora' => 'required',
        'detalle' => 'required|string|max:255',
    ]);

    $response = Http::post('http://localhost:3000/api/citas/', [
        'id_paciente' => $request->paciente,
        'id_medico' => $request->medico,
        'hora' => $request->hora,
        'fecha' => $request->fecha,
        'detalle' => $request->detalle,
    ]);

    if ($response->successful()) {
        return redirect()->route('citas')->with('success', 'Cita creada correctamente.');
    } else {
        $errorMessage = $response->json()['message'] ?? 'Error desconocido al guardar la cita.';
        return back()->with('error', $errorMessage);
    }
}
}

