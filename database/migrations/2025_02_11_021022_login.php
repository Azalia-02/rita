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
        Schema::create('tb_login', function (Blueprint $table) {
            $table->bigIncrements('id_login');
            $table->string('nombre', 50);
            $table->string('app', 50);
            $table->string('apm', 50);
            $table->string('email');
            $table->string('password');
            $table->string('rol')->default('user');
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
