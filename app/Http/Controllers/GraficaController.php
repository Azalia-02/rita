<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use ArielMejiaDev\LarapexCharts\LarapexChart;


class GraficaController extends Controller
{
    public function mostrarGrafica()
    {
        // Obtener datos de la API
        $response = Http::get('http://localhost:3000/api/contar-por-sexo');
        $data = $response->json();
    
        // Verificar si la respuesta tiene datos
        if (!isset($data['hombres'])) {
            return view('grafica', ['chart' => null]);
        }
    
        // Obtener el número de hombres y mujeres
        $hombres = $data['hombres'];
        $mujeres = $data['mujeres'];
    
        // Crear gráfica
        $chart = (new LarapexChart)
            ->setType('pie') // Cambia el tipo de gráfica según lo que necesites
            ->setTitle('Pacientes por Sexo')
            ->setLabels(['Hombres', 'Mujeres'])
            ->setDataset([$hombres, $mujeres]);
    
        // Obtener la configuración de la gráfica
        $chartData = $chart->toVue();
    
        // Depuración: Verifica los datos que se están pasando a la vista
        //dd($chartData);
    
        return view('grafica', compact('chart', 'chartData'));
    }
}
