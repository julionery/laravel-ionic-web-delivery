<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSoftDeletesToTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('produtos', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('categorias', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('clientes', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('componentes', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('cupoms', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('empresas', function (Blueprint $table) {
            $table->string('emailPedidos')->nullable();
            $table->softDeletes();
        });
        Schema::table('pedidos', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('pedido_items', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('produto_item_pedidos', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('produto_items', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('usuarios', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
