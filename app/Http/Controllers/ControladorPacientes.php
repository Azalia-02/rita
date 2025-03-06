<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use App\Imports\PacientesImport;
use App\Exports\PacientesExport;
use Carbon\Carbon;


class ControladorPacientes extends Controller
{

    public function export(Request $request)
{
    // Obtener los filtros desde la solicitud
    $search = $request->input('search');

    // Si hay un filtro, aplicar la búsqueda
    $query = DB::table('tb_pacientes');

    if (!empty($search)) {
        $query->where('nombre', 'LIKE', "%$search%")
              ->orWhere('app', 'LIKE', "%$search%")
              ->orWhere('apm', 'LIKE', "%$search%")
              ->orWhere('sex', 'LIKE', "%$search%")
              ->orWhere('tel', 'LIKE', "%$search%");
    } 

    $pacientes = $query->get(); // Ejecutar la consulta

    return Excel::download(new PacientesExport($pacientes), 'pacientes.xlsx');
}


    public function import(Request $request)
    {
        // Verificar si se subió un archivo
        if (!$request->hasFile('file')) {
            return back()->with('error', 'No se ha subido ningún archivo.');
        }
    
        $file = $request->file('file');
        $data = Excel::toArray([], $file)[0]; // Leer la primera hoja del archivo
    
        // Verificar que hay datos
        if (empty($data) || count($data) < 2) {
            return back()->with('error', 'El archivo está vacío o no tiene datos válidos.');
        }
    
        // Saltar la primera fila (encabezados)
        unset($data[0]);
    
        $insertados = 0;
        $duplicados = 0;

        
    
        foreach ($data as $row) {
            $telefono = $row[6]; // Suponiendo que el teléfono está en la columna 6 (índice 5)
    
            // Verificar si el teléfono ya existe en la base de datos
            $existe = DB::table('tb_pacientes')->where('tel', $telefono)->exists();
    
            if (!$existe) {
                // Convertir la fecha de Excel a formato MySQL (YYYY-MM-DD)
                $fechaNacimiento = is_numeric($row[5]) ? Date::excelToDateTimeObject($row[5])->format('Y-m-d') : null;
                $now = Carbon::now();
                // Insertar solo si la fecha es válida
                DB::table('tb_pacientes')->insert([
                    'nombre' => $row[1], // Nombre
                    'app' => $row[2], // Apellido paterno
                    'apm' => $row[3], // Apellido materno
                    'sex' => $row[4], // Sexo
                    'fn' => $fechaNacimiento, // Fecha de nacimiento
                    'tel' => $telefono, // Teléfono
                    'created_at' => $now, // Fecha de creación
                    'updated_at' => $now  // Fecha de actualización

                ]);
    
                $insertados++;
            } else {
                $duplicados++;
            }
        }
    
        return back()->with('success', "Importación completada. Insertados: $insertados | Duplicados: $duplicados");
    }

    public function pacientes(Request $request)
    {
        // Obtener valores de búsqueda y paginación desde el request
        $search = $request->query('buscar', ''); // Valor del input de búsqueda
        $page = $request->query('page', 1); // Página actual, por defecto la 1
        $limit = 6; // Cantidad de pacientes por página

        // Hacer la solicitud GET a la API con los filtros
        $response = Http::get('http://localhost:3000/api/pacientes/', [
            'search' => $search, 
            'page' => $page, 
            'limit' => $limit
        ]);


        if ($response->successful()) {
            $data = $response->json();

            return view('pacientes', [
                'pacientes' => $data['data'] ?? [], // Lista de pacientes
                'total' => $data['total'] ?? 0, // Total de registros
                'limit' => $limit, // Límite por página
                'search' => $search, // Término de búsqueda actual
                'page' => $page // Página actual
            ]);
        } else {
            return response()->json(['error' => 'Error al consultar la API'], 500);
        }
    }
    

    public function paciente_detalle($id){
        // Hacemos una solicitud GET a una Api externa
        $response = Http::get('http://localhost:3000/api/pacientes/'. $id);

        // Verificamos si la solicitud fue exitosa
        if ($response->successful()) {
            $data = $response->json(); // Obtiene los datos en formato JSON
            
            //return view('getData2')->with(['data' => $data]);

            return view('paciente_detalle', compact('data')); //Pasamos los datos a una vista
        }else{
            return response()->json(['error' => 'error al consultar la api'], 500);
        }
    }

    public function paciente_alta(){
        return view('paciente_alta');
    }

    public function paciente_registrar(Request $request){
        $response = Http::post('http://localhost:3000/api/pacientes/', [
            'nombre' => $request->nombre,
            'app' => $request->app,
            'apm' => $request->apm,
            'sex' => $request->sex,
            'fn' => $request->fn,
            'tel' => $request->tel,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        if ($response->successful()) {
            return redirect()->route('pacientes');
            //return response()->json(['message' => 'Datos enviados correctamente']);
        }

    }

    public function paciente_actualizar($id){
        $response = Http::get ('http://localhost:3000/api/pacientes/'. $id);

        $data = $response->json();

        return view('paciente_editar', compact('data'));
    }
    

    public function paciente_salvar(Request $request)
    {
        $response = Http::put('http://localhost:3000/api/pacientes/'.$request->id, [
            'nombre' => $request->nombre,
            'app' => $request->app,
            'apm' => $request->apm,
            'sex' => $request->sex,
            'fn' => $request->fn,
            'tel' => $request->tel,
        ]);

        if ($response->successful()) {
            return redirect()->route('pacientes');
            //return response()->json(['message' => 'Datos actualizados correctamente'], 200);
        }else{
            return response()->json(['error' => 'Error al actualizar datos'], 500);
        }
    }

    public function paciente_borrar($id)
    {
        //dd($id);
        //Hacemos una solicitud DELETE la API para eliminar el recurso
        $response = Http::delete('http://localhost:3000/api/pacientes/'. $id);
        
        //verificamos si la solicitud fue exitosa
        if ($response->successful()) {
            return redirect()->route('pacientes');
            //return response()->json(['message' => 'Recurso eliminado correctamente'], 200);
        }else{
            return response()->json(['error' => 'Error al eliminar el recurso'], 500);
        }
    }

}
