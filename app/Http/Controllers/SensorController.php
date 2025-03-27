<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sensor;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;

class SensorController extends Controller
{
    // ✅ Método para mostrar la vista con los datos de los sensores
    public function mostrarSensores(Request $request)
    {
        $apiUrl = 'http://localhost:3000/api/sensores';

        try {
            $response = Http::get($apiUrl);

            if ($response->successful()) {
                $data = $response->json();

                $currentPage = LengthAwarePaginator::resolveCurrentPage();
                $perPage = 10;
                $currentPageData = array_slice($data, ($currentPage - 1) * $perPage, $perPage);

                $sensores = new LengthAwarePaginator(
                    $currentPageData,
                    count($data),
                    $perPage,
                    $currentPage,
                    ['path' => $request->url()]
                );

                return view('sensores', compact('sensores'));
            } else {
                return view('sensores')->withErrors(['error' => 'Error al conectar con la API']);
            }
        } catch (\Exception $e) {
            return view('sensores')->withErrors(['error' => 'Error al conectar con la API: ' . $e->getMessage()]);
        }
    }

    // ✅ Método para insertar o actualizar los datos
    public function store(Request $request)
    {
        $request->validate([
            'id_login' => 'required|integer',
            'temperatura_ds18b20' => 'nullable|numeric',
            'ecg' => 'nullable|json',
            'bpm' => 'nullable|integer',
            'spo2' => 'nullable|numeric',
            'bpm_max30102' => 'nullable|integer',
            'temperatura_dht11' => 'nullable|numeric',
            'humedad' => 'nullable|numeric'
        ]);

        $sensor = Sensor::where('id_login', $request->id_login)->first();

        if ($sensor) {
            $sensor->update([
                'temperatura_ds18b20' => $request->temperatura_ds18b20,
                'ecg' => json_encode($request->ecg),
                'bpm' => $request->bpm,
                'spo2' => $request->spo2,
                'bpm_max30102' => $request->bpm_max30102,
                'temperatura_dht11' => $request->temperatura_dht11,
                'humedad' => $request->humedad,
                'created_at' => now()
            ]);
        } else {
            Sensor::create([
                'id_login' => $request->id_login,
                'temperatura_ds18b20' => $request->temperatura_ds18b20,
                'ecg' => json_encode($request->ecg),
                'bpm' => $request->bpm,
                'spo2' => $request->spo2,
                'bpm_max30102' => $request->bpm_max30102,
                'temperatura_dht11' => $request->temperatura_dht11,
                'humedad' => $request->humedad
            ]);
        }

        return response()->json(['mensaje' => 'Datos almacenados correctamente'], 200);
    }

    // ✅ Método para obtener todos los registros
    public function index_data()
    {
        $sensores = Sensor::orderBy('created_at', 'desc')->paginate(10);
        return response()->json($sensores);
    }

    // ✅ Método para obtener un registro específico por id_login
    public function show($id_login)
    {
        $sensor = Sensor::where('id_login', $id_login)->first();

        if ($sensor) {
            return response()->json($sensor);
        } else {
            return response()->json(['mensaje' => 'No encontrado'], 404);
        }
    }

    public function mostrarTarjetas()
{
    $apiUrl = 'http://localhost:3000/api/sensores';

    try {
        $response = Http::get($apiUrl);

        if ($response->successful()) {
            $data = $response->json();
            return view('partials.cards-sensores', ['sensores' => $data]);
        }

    } catch (\Exception $e) {
        return response()->json(['error' => 'Error al obtener los datos'], 500);
    }
}


}
