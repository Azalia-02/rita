<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use ArielMejiaDev\LarapexCharts\LarapexChart;


class GraficaMedicos extends Controller
{
    public function grafica_medicos()
    {
        // Obtener datos de la API
        $response = Http::get('http://localhost:3000/api/medicos-por-sexo');
        $data = $response->json();
    
        // Verificar si la respuesta tiene datos
        if (!isset($data['hombres'])) {
            return view('grafica_medicos', ['chart' => null]);
        }
    
        // Obtener el número de hombres y mujeres
        $hombres = $data['hombres'];
        $mujeres = $data['mujeres'];
    
        // Crear gráfica
        $chart = (new LarapexChart)
            ->setType('donut') // Cambia el tipo de gráfica según lo que necesites
            ->setTitle('Medicos por Sexo')
            ->setLabels(['Hombres', 'Mujeres'])
            ->setDataset([$hombres, $mujeres]);
    
        // Obtener la configuración de la gráfica
        $chartData = $chart->toVue();
    
        // Depuración: Verifica los datos que se están pasando a la vista
        //dd($chartData);
    
        return view('grafica_medicos', compact('chart', 'chartData'));
    }
}
