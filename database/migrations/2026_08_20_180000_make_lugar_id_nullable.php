<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pedidos', function (Blueprint $table) {
            $table->foreignId('lugar_id')->nullable()->change();
        });

        Schema::table('pedidos_cocos', function (Blueprint $table) {
            $table->foreignId('lugar_id')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('pedidos', function (Blueprint $table) {
            $table->foreignId('lugar_id')->nullable(false)->change();
        });

        Schema::table('pedidos_cocos', function (Blueprint $table) {
            $table->foreignId('lugar_id')->nullable(false)->change();
        });
    }
};
