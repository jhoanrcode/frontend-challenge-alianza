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
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->integer('identificacion');
            $table->longText('direccion');
            $table->string('telefono');
            $table->string('ciudad');
            $table->timestamps();
        });

        Schema::create('cargo_empleados', function (Blueprint $table) {
            $table->id();
            $table->integer('id_empleados');
            $table->string('cargo');
            $table->string('jefe');
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
        Schema::dropIfExists('cargo_empleados');
    }
};
