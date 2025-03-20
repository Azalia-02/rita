<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class citas extends Migration
{
    public function up()
    {
        Schema::create('tb_citas', function (Blueprint $table) {
            $table->bigIncrements('id_cita'); 
            $table->date('fecha'); 
            $table->time('hora'); 
            $table->unsignedBigInteger('id_paciente'); 
            $table->unsignedBigInteger('id_medico'); 
            $table->text('detalle'); 
            $table->timestamps(); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('tb_citas');
    }
}