<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('tb_sensor', function (Blueprint $table) {
            $table->bigIncrements('id_sensor');    // ID autoincremental
            $table->unsignedBigInteger('id_login'); // ID de login
            $table->float('temperatura_ds18b20')->nullable();
            $table->text('ecg')->nullable();
            $table->integer('bpm')->nullable();
            $table->float('spo2')->nullable();
            $table->integer('bpm_max30102')->nullable();
            $table->float('temperatura_dht11')->nullable();
            $table->float('humedad')->nullable();
            $table->timestamps();  // created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('tb_sensor');
    }
};
