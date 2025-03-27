<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    use HasFactory;

    protected $table = 'tb_sensor';  // Nombre de la tabla

    protected $fillable = [
        'id_login',
        'temperatura_ds18b20',
        'ecg',
        'bpm',
        'spo2',
        'bpm_max30102',
        'temperatura_dht11',
        'humedad'
    ];

    public $timestamps = true;  // Usar timestamps para actualizar automáticamente
}
