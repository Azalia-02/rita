<?php

namespace App\Imports;

use App\Models\Paciente;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Carbon\Carbon;

class PacientesImport implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection( Collection $rows)
    {
        foreach ($rows as $row) {
            // Verificar si el número de teléfono ya existe en la base de datos
            $existe = DB::table('tb_pacientes')->where('tel', $row['telefono'])->exists();
        
            // Convertir la fecha al formato correcto
        $fecha = null;
        if (!empty($row['fn'])) {
            try {
                $fecha = Carbon::parse($row['fn'])->format('Y-m-d');
            } catch (\Exception $e) {
                $fecha = null; // Si falla, dejarla en null
            }
        }

            if (!$existe) {
                DB::table('tb_pacientes')->insert([
                    'nombre' => $row['nombre'],
                    'app' => $row['apellido_paterno'],
                    'apm' => $row['apellido_materno'],
                    'sex' => $row['sexo'],
                    'fn' => $row['fecha_de_nacimiento'],
                    'tel' => $row['telefono'],
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
    }
}
