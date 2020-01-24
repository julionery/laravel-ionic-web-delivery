<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('categoria_id')->unsigned();
            $table->integer('empresa_id')->unsigned();
            $table->string('nome');
            $table->text('descricao');
            $table->char('tamanho');
            $table->decimal('preco');
            $table->text('imagem')->nullable();
            $table->timestamps();
        });

        Schema::table('produtos', function($table){
            $table->foreign('categoria_id')->references('id')->on('categorias');
            $table->foreign('empresa_id')->references('id')->on('empresas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('produtos');
    }
}
