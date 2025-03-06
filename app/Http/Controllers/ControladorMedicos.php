<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ControladorMedicos extends Controller
{

    public function medicos(Request $request)
    {
        // Obtener valores de búsqueda y paginación desde el request
        $search = $request->query('buscar', ''); // Valor del input de búsqueda
        $page = $request->query('page', 1); // Página actual, por defecto la 1
        $limit = 6; // Cantidad de pacientes por página

        // Hacer la solicitud GET a la API con los filtros
        $response = Http::get('http://localhost:3000/api/medicos/', [
            'search' => $search, 
            'page' => $page, 
            'limit' => $limit
        ]);


        if ($response->successful()) {
            $data = $response->json();

            return view('medicos', [
                'medicos' => $data['data'] ?? [], // Lista de medicos
                'total' => $data['total'] ?? 0, // Total de registros
                'limit' => $limit, // Límite por página
                'search' => $search, // Término de búsqueda actual
                'page' => $page // Página actual
            ]);
        } else {
            return response()->json(['error' => 'Error al consultar la API'], 500);
        }
    }
    

    public function medico_detalle($id){
        // Hacemos una solicitud GET a una Api externa
        $response = Http::get('http://localhost:3000/api/medicos/'. $id);

        // Verificamos si la solicitud fue exitosa
        if ($response->successful()) {
            $data = $response->json(); // Obtiene los datos en formato JSON
            
            //return view('getData2')->with(['data' => $data]);

            return view('medico_detalle', compact('data')); //Pasamos los datos a una vista
        }else{
            return response()->json(['error' => 'error al consultar la api'], 500);
        }
    }

    public function medico_alta(){
        return view('medico_alta');
    }

    public function medico_registrar(Request $request){
        $response = Http::post('http://localhost:3000/api/medicos/', [
            'clave' => $request->clave,
            'nombre' => $request->nombre,
            'app' => $request->app,
            'apm' => $request->apm,
            'fn' => $request->fn,
            'sex' => $request->sex,
            'tel' => $request->tel,
            'email' => $request->email,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        if ($response->successful()) {
            return redirect()->route('medicos');
            //return response()->json(['message' => 'Datos enviados correctamente']);
        }

    }

    public function medico_actualizar($id){
        $response = Http::get ('http://localhost:3000/api/medicos/'. $id);

        $data = $response->json();

        return view('medico_editar', compact('data'));
    }
    

    public function medico_salvar(Request $request)
    {
        $response = Http::put('http://localhost:3000/api/medicos/'.$request->id, [
            'clave' => $request->clave,
            'nombre' => $request->nombre,
            'app' => $request->app,
            'apm' => $request->apm,
            'fn' => $request->fn,
            'sex' => $request->sex,
            'tel' => $request->tel,
            'email' => $request->email,
        ]);

        if ($response->successful()) {
            return redirect()->route('medicos');
            //return response()->json(['message' => 'Datos actualizados correctamente'], 200);
        }else{
            return response()->json(['error' => 'Error al actualizar datos'], 500);
        }
    }

    public function medico_borrar($id)
    {
        //dd($id);
        //Hacemos una solicitud DELETE la API para eliminar el recurso
        $response = Http::delete('http://localhost:3000/api/medicos/'. $id);
        
        //verificamos si la solicitud fue exitosa
        if ($response->successful()) {
            return redirect()->route('medicos');
            //return response()->json(['message' => 'Recurso eliminado correctamente'], 200);
        }else{
            return response()->json(['error' => 'Error al eliminar el recurso'], 500);
        }
    }

}
