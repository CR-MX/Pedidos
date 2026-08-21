<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lugares_cocos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });

        Schema::create('tipos_cocos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });

        Schema::create('colores_cocos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });

        Schema::create('pedidos_cocos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('red_social')->nullable();
            $table->decimal('anticipo', 10, 2);
            $table->decimal('total', 10, 2);
            $table->dateTime('fecha_hora_entrega')->nullable();
            $table->foreignId('lugar_id')->constrained('lugares_cocos')->cascadeOnDelete();
            $table->text('informacion_adicional')->nullable();
            $table->enum('entrega', ['pendiente', 'entregado'])->default('pendiente');
            $table->timestamps();
        });

        Schema::create('articulos_pedidos_cocos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pedido_id')->constrained('pedidos_cocos')->cascadeOnDelete();
            $table->string('nombre');
            $table->string('color');
            $table->integer('cantidad');
            $table->foreignId('tipo_id')->constrained('tipos_cocos')->cascadeOnDelete();
            $table->boolean('realizado')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('articulos_pedidos_cocos');
        Schema::dropIfExists('pedidos_cocos');
        Schema::dropIfExists('colores_cocos');
        Schema::dropIfExists('tipos_cocos');
        Schema::dropIfExists('lugares_cocos');
    }
};
