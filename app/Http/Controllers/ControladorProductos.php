<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ControladorProductos extends Controller
{
    public function productos(Request $request)
    {
        $response = Http::get('http://localhost:3000/api/productos/');

        if ($response->successful()) {
            $data = $response->json();
            return view('productos', compact('data'));
        } else {
            return response()->json(['error' => 'Error al consultar la API'], 500);
        }
    }
    

    public function producto_detalle($id){
        $response = Http::get('http://localhost:3000/api/productos/'. $id);

        if ($response->successful()) {
            $data = $response->json();

            return view('producto_detalle', compact('data')); 
        }else{
            return response()->json(['error' => 'error al consultar la api'], 500);
        }
    }

    public function producto_alta(){
        return view('producto_alta');
    }

    public function producto_registrar(Request $request){
        if ($request->hasFile('imagen')) {
            $fotoPath = $request->file('imagen')->store('img', 'public'); 
            $fotoUrl = str_replace('public/', '', $fotoPath); 
        } else {
            return redirect()->back()->with('error', 'No se ha subido ninguna foto.');
        }

        $response = Http::post('http://localhost:3000/api/productos/', [
            'nombre' => $request->nombre,
            'precio' => $request->precio,
            'descripcion' => $request->descripcion,
            'stock' => $request->stock,
            'imagen' => $fotoUrl,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        if ($response->successful()) {
            return redirect()->route('productos');
        }

    }

    public function producto_salvar(Request $request, $id){
    if ($request->hasFile('imagen')) {
        $fotoPath = $request->file('imagen')->store('img', 'public');
        $fotoUrl = $fotoPath;
    } else {
        $fotoUrl = $request->imagen_actual;
    }

    $response = Http::put('http://localhost:3000/api/productos/' . $id, [
        'nombre' => $request->nombre,
        'precio' => $request->precio,
        'descripcion' => $request->descripcion,
        'stock' => $request->stock,
        'imagen' => $fotoUrl, 
    ]);

    if ($response->successful()) {
        return redirect()->route('productos'); 
    } else {
        return response()->json(['error' => 'Error al actualizar datos'], 500); 
    }
    }

    public function producto_actualizar($id){
    $response = Http::get('http://localhost:3000/api/productos/' . $id);

    if ($response->successful()) {
        $data = $response->json();

        return view('producto_salvar', compact('data'));
    } else {
        return response()->json(['error' => 'Error al consultar la API'], 500);
    }
    }

    public function producto_borrar($id)
    {
        $response = Http::delete('http://localhost:3000/api/productos/'. $id);
        
        if ($response->successful()) {
            return redirect()->route('productos');
        }else{
            return response()->json(['error' => 'Error al eliminar el recurso'], 500);
        }
    }
}
