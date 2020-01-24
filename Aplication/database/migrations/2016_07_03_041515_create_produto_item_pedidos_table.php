<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdutoItemPedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produto_item_pedidos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pedido_item_id')->unsigned();
            $table->integer('componente_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('produto_item_pedidos', function($table){
            $table->foreign('pedido_item_id')->references('id')->on('pedido_items');
            $table->foreign('componente_id')->references('id')->on('componentes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('produto_item_pedidos');
    }
}
