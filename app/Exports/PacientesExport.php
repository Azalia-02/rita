<?php

namespace App\Exports;

use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class PacientesExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $pacientes;

    public function __construct($pacientes)
    {
        $this->pacientes = $pacientes;
    }
    
    public function collection()
    {
        return $this->pacientes;
    }

    public function headings(): array
    {
        return [
            'ID', 
            'Nombre', 
            'Apellido Paterno', 
            'Apellido Materno', 
            'Sexo', 
            'Fecha de nacimiento',
            'Teléfono'
        ];
    }

}
