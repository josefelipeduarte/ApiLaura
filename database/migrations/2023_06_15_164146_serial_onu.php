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
        Schema::create('serial_onu', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_onu_estoque', 50);
            $table->string('serial_estoque', 20);
            $table->string('motivo_entrega', 50);
            $table->string('desc_estoque', 255);
            $table->string('nome_responsavel', 100);
            $table->string('user', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('serial_onu');
    }
};
