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
        Schema::create('credenciales', function (Blueprint $table) {
            $table->id();

            $table->text('foto')->nullable();
            $table->text('firma')->nullable();
            $table->string('curp', 18)->nullable();
            $table->string('apellido_paterno', 100)->nullable();
            $table->string('apellido_materno', 100)->nullable();
            $table->string('nombres', 200)->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->date('fecha_expedicion')->nullable();
            $table->date('fecha_vencimiento')->nullable();
            $table->string('tipo_licencia', 50)->nullable();
            $table->unsignedBigInteger('numero_licencia');
            $table->unsignedBigInteger('oficina_emisora_id');

            $table->date('fecha_antiguedad')->nullable();
            $table->string('sexo', 1)->nullable();
            $table->string('tipo_sangre', 5)->nullable();
            $table->boolean('donador_organos')->nullable();
            $table->text('restricciones')->nullable();
            $table->string('en_caso_accidente_nombre', 200)->nullable();
            $table->string('en_caso_accidente_numero', 20)->nullable();
            $table->foreign('oficina_emisora_id')->references('id')->on('oficinas_emisoras')->onDelete('cascade');
            $table->unique(['oficina_emisora_id', 'numero_licencia']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credenciales');
    }
};
