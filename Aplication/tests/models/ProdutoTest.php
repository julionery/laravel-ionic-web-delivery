<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProdutoTest extends TestCase
{
    use DatabaseTransactions;

    //criando produto
    public function test_criar_produto()
    {
        $categoria = \WebDelivery\Models\Categoria::create([
            'empresa_id' => 1,
            'nome' => 'Teste'
        ]);

        \WebDelivery\Models\Produto::create([
            'empresa_id' => 1,
            'categoria_id' => $categoria->id,
            'nome' => 'Teste',
            'descricao' => 'Testando produtos',
            'tamanho' => 'P',
            'preco' => '25',
            'adicionais' => 1
        ]);

        $this->seeInDatabase('produtos', ['nome' => 'Teste']);
    }

    //listando produto
    public function test_listar_produto()
    {
        $categoria = \WebDelivery\Models\Categoria::create([
            'empresa_id' => 1,
            'nome' => 'Teste'
        ]);

        $produto = \WebDelivery\Models\Produto::create([
            'empresa_id' => 1,
            'categoria_id' => $categoria->id,
            'nome' => 'Teste',
            'descricao' => 'Testando produtos',
            'tamanho' => 'P',
            'preco' => '25',
            'adicionais' => 1
        ]);

        $buscaProduto = \WebDelivery\Models\Produto::find($produto->id);

        $this->assertNotEquals($buscaProduto, '');
    }

    //atualizando produto
    public function test_atualizar_produto()
    {
        $categoria = \WebDelivery\Models\Categoria::create([
            'empresa_id' => 1,
            'nome' => 'Teste'
        ]);

        $produto = \WebDelivery\Models\Produto::create([
            'empresa_id' => 1,
            'categoria_id' => $categoria->id,
            'nome' => 'Teste',
            'descricao' => 'Testando produtos',
            'tamanho' => 'P',
            'preco' => '25',
            'adicionais' => 1
        ]);

        $produto->nome = 'Teste Atualizando Produto';

        $produto->save();

        $this->seeInDatabase('produtos', ['nome' => 'Teste Atualizando Produto']);
    }

    //deletando produto
    public function test_deletar_produto()
    {
        $categoria = \WebDelivery\Models\Categoria::create([
            'empresa_id' => 1,
            'nome' => 'Teste'
        ]);

        $produto = \WebDelivery\Models\Produto::create([
            'empresa_id' => 1,
            'categoria_id' => $categoria->id,
            'nome' => 'Teste',
            'descricao' => 'Testando produtos',
            'tamanho' => 'P',
            'preco' => '25',
            'adicionais' => 1
        ]);

        $produto->delete();

        $this->assertNotEquals($produto['deleted_at'], '');
    }
}
