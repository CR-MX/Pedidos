<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('articulos_pedidos_cocos', function (Blueprint $table) {
            $table->string('color')->nullable()->change();
            $table->string('unidad')->default('pza')->after('cantidad');
        });
    }

    public function down(): void
    {
        Schema::table('articulos_pedidos_cocos', function (Blueprint $table) {
            $table->string('color')->nullable(false)->change();
            $table->dropColumn('unidad');
        });
    }
};
