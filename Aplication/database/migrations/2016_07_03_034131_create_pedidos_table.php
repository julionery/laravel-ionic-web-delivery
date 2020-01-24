<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('empresa_id')->unsigned();
            $table->integer('cliente_id')->unsigned();
            $table->integer('usuario_entregador_id')->unsigned()->nullable();
            $table->decimal('total');
            $table->smallInteger('status')->default(0);
            $table->smallInteger('retirada');
            $table->smallInteger('pagamento');
            $table->decimal('troco');
            $table->timestamps();
        });

        Schema::table('pedidos', function($table){
            $table->foreign('empresa_id')->references('id')->on('empresas');
            //$table->foreign('cliente_id')->references('id')->on('clientes'); //testar
            $table->foreign('usuario_entregador_id')->references('id')->on('usuarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pedidos');
    }
}
