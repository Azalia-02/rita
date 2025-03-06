<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tb_datos', function (Blueprint $table) {
            $table->bigIncrements('id_dato');
            $table->string('t_corporal');
            $table->string('saturacion');
            $table->string('frecuencia');
            $table->text('anomalia');
            $table->integer('id_paciente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
