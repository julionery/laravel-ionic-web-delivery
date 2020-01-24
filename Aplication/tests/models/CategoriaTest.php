<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CategoriaTest extends TestCase
{
    use DatabaseTransactions;

    //criando Categoria
    public function test_criar_categoria()
    {
        \WebDelivery\Models\Categoria::create([
            'empresa_id' => 1,
            'nome' => 'Teste'
        ]);

        $this->seeInDatabase('categorias', ['nome' => 'Teste']);
    }

    //listando Categoria
    public function test_listar_categoria()
    {
        $categoria = \WebDelivery\Models\Categoria::create([
            'empresa_id' => 1,
            'nome' => 'Teste'
        ]);

        $buscaCategoria = \WebDelivery\Models\Categoria::find($categoria->id);

        $this->assertNotEquals($buscaCategoria, '');
    }

    //atualizando Categoria
    public function test_atualizar_categoria()
    {
        $categoria = \WebDelivery\Models\Categoria::create([
            'empresa_id' => 1,
            'nome' => 'Teste Categoria'
        ]);

        $categoria->nome = 'Teste Atualizando Categoria';

        $categoria->save();

        $this->seeInDatabase('categorias', ['nome' => 'Teste Atualizando Categoria']);
    }

    //deletando Categoria
    public function test_deletar_categoria()
    {
        $categoria = \WebDelivery\Models\Categoria::create([
            'empresa_id' => 1,
            'nome' => 'Teste Categoria'
        ]);

        $categoria->delete();

        $this->assertNotEquals($categoria['deleted_at'], '');
    }
}
