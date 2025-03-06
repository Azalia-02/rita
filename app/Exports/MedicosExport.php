<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Concerns\WithHeadings;


class MedicosExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $medicos;

    public function __construct($medicos)
    {
        $this->medicos = $medicos;
    }

    public function collection()
    {
        return $this->medicos;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Clave',
            'Nombre', 
            'Apellido Paterno', 
            'Apellido Materno',
            'Fecha de nacimiento',
            'Sexo', 
            'Teléfono',
            'Email'
        ];
    }
}
