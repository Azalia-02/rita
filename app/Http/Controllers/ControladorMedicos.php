<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use App\Exports\MedicosExport;
use Carbon\Carbon;

class ControladorMedicos extends Controller
{

    public function export(Request $request)
{
    // Obtener los filtros desde la solicitud
    $search = $request->input('search');

    // Si hay un filtro, aplicar la búsqueda
    $query = DB::table('tb_medicos');

    if (!empty($search)) {
        $query->where('clave', 'LIKE', "%$search%")
              ->orWhere('nombre', 'LIKE', "%$search%")
              ->orWhere('app', 'LIKE', "%$search%")
              ->orWhere('apm', 'LIKE', "%$search%")
              ->orWhere('sex', 'LIKE', "%$search%")
              ->orWhere('tel', 'LIKE', "%$search%");
    } 

    $medicos = $query->get(); // Ejecutar la consulta

    return Excel::download(new MedicosExport($medicos), 'medicos.xlsx');
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
            $email = $row[8]; // Suponiendo que el teléfono está en la columna 6 (índice 5)
    
            // Verificar si el teléfono ya existe en la base de datos
            $existe = DB::table('tb_medicos')->where('email', $email)->exists();
    
            if (!$existe) {
                // Convertir la fecha de Excel a formato MySQL (YYYY-MM-DD)
                $fechaNacimiento = is_numeric($row[5]) ? Date::excelToDateTimeObject($row[5])->format('Y-m-d') : null;
                $now = Carbon::now();
                // Insertar solo si la fecha es válida
                DB::table('tb_medicos')->insert([
                    'clave' => $row[1], 
                    'nombre' => $row[2], 
                    'app' => $row[3], 
                    'apm' => $row[4],
                    'fn' => $fechaNacimiento, // Fecha de nacimiento
                    'sex' => $row[6], 
                    'tel' => $row[7], // Teléfono
                    'email' => $email,
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

    public function medicos(Request $request)
    {
        // Obtener valores de búsqueda y paginación desde el request
        $search = $request->query('buscar', ''); // Valor del input de búsqueda
        $page = $request->query('page', 1); // Página actual, por defecto la 1
        $limit = 6; // Cantidad de pacientes por página

        // Hacer la solicitud GET a la API con los filtros
        $response = Http::get('http://3.83.41.64:3003/api/medicos/', [
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
        $response = Http::get('http://3.83.41.64:3003/api/medicos/'. $id);

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
        $response = Http::post('http://3.83.41.64:3003/api/medicos/', [
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
        $response = Http::get ('http://3.83.41.64:3003/api/medicos/'. $id);

        $data = $response->json();

        return view('medico_editar', compact('data'));
    }
    

    public function medico_salvar(Request $request)
    {
        $response = Http::put('http://3.83.41.64:3003/api/medicos/'.$request->id, [
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
        $response = Http::delete('http://3.83.41.64:3003/api/medicos/'. $id);
        
        //verificamos si la solicitud fue exitosa
        if ($response->successful()) {
            return redirect()->route('medicos');
            //return response()->json(['message' => 'Recurso eliminado correctamente'], 200);
        }else{
            return response()->json(['error' => 'Error al eliminar el recurso'], 500);
        }
    }

}
