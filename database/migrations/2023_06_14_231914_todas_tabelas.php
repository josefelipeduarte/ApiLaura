<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cadastro_serial', function (Blueprint $table) {
            $table->increments('id_estoque');
            $table->string('tipoOnu_estoque', 10);
            $table->string('serial_estoque', 12);
            $table->string('motivoEntrega_estoque', 50);
            $table->string('desc_estoque', 100);
            $table->string('nome_responsavel', 50);
            $table->string('usuario_estoque', 30);
            $table->timestamp('data_estoque')->nullable();
        });
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id_user');
            $table->string('nome', 255);
            $table->string('email', 255);
            $table->string('senha', 100);
            $table->string('cargo', 50);
            $table->rememberToken();
            $table->timestamps();
        });
        Schema::create('cargo_users', function (Blueprint $table) {
            $table->bigIncrements('id_cargo');
            $table->string('nome_cargo', 50);
        });
        Schema::create('responsavel_entrega', function (Blueprint $table) {
            $table->bigIncrements('id_resp');
            $table->string('nome', 255);
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cadastro_serial');
        Schema::dropIfExists('cargo_users');
        Schema::dropIfExists('responsavel_entrega');
        Schema::dropIfExists('users');
    }
};
