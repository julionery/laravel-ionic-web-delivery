<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PedidoTest extends TestCase
{
    use DatabaseTransactions;

    //criando pedido
    public function test_criar_pedido()
    {
        $usuario = \WebDelivery\Models\User::create([
            'empresa_id' => 1,
            'nome' => 'Teste Usuário',
            'email' => 'teste@teste.com',
            'password' => bcrypt(123456),
            'tipo' => 'admin'
        ]);

        $cliente = \WebDelivery\Models\Cliente::create([
            'user_id' => $usuario->id,
            'telefone' => '(64)99252-8888',
            'endereco' => 'Rua 6',
            'bairro' => 'Conjunto Morada do Sol',
            'cep' => '75909-200',
            'cidade' => 'Rio Verde',
            'estado' => 'Goiás',
            'sexo' => 'M'
        ]);

        \WebDelivery\Models\Pedido::create([
            'empresa_id' => 1,
            'cliente_id' => $cliente->id,
            'total' => '555',
            'retirada' => '1',
            'pagamento' => '1',
            'troco' => '600',
        ]);

        $this->seeInDatabase('pedidos', ['total' => '555']);
    }

    //criando pedido com itens
    public function test_criar_pedido_item()
    {
        $usuario = \WebDelivery\Models\User::create([
            'empresa_id' => 1,
            'nome' => 'Teste Usuário',
            'email' => 'teste@teste.com',
            'password' => bcrypt(123456),
            'tipo' => 'admin'
        ]);

        $cliente = \WebDelivery\Models\Cliente::create([
            'user_id' => $usuario->id,
            'telefone' => '(64)99252-8888',
            'endereco' => 'Rua 6',
            'bairro' => 'Conjunto Morada do Sol',
            'cep' => '75909-200',
            'cidade' => 'Rio Verde',
            'estado' => 'Goiás',
            'sexo' => 'M'
        ]);

        $pedido = \WebDelivery\Models\Pedido::create([
            'empresa_id' => 1,
            'cliente_id' => $cliente->id,
            'total' => '555',
            'retirada' => '1',
            'pagamento' => '1',
            'troco' => '600',
        ]);

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

        \WebDelivery\Models\PedidoItem::create([
            'pedido_id' => $pedido->id,
            'produto_id' => $produto->id,
            'preco' => '666',
            'qtd' => '6',
            'meia' => '1',
            'obs' => 'testando pedido itens'
        ]);

        $this->seeInDatabase('pedidos', ['total' => '555']);
        $this->seeInDatabase('pedido_items', [
            'pedido_id' => $pedido->id,
            'obs' => 'testando pedido itens'
        ]);
    }

    //testando pedidos pelo item
    public function test_get_item_by_pedido()
    {
        $usuario = \WebDelivery\Models\User::create([
            'empresa_id' => 1,
            'nome' => 'Teste Usuário',
            'email' => 'teste@teste.com',
            'password' => bcrypt(123456),
            'tipo' => 'admin'
        ]);

        $cliente = \WebDelivery\Models\Cliente::create([
            'user_id' => $usuario->id,
            'telefone' => '(64)99252-8888',
            'endereco' => 'Rua 6',
            'bairro' => 'Conjunto Morada do Sol',
            'cep' => '75909-200',
            'cidade' => 'Rio Verde',
            'estado' => 'Goiás',
            'sexo' => 'M'
        ]);

        $pedido = \WebDelivery\Models\Pedido::create([
            'empresa_id' => 1,
            'cliente_id' => $cliente->id,
            'total' => '555',
            'retirada' => '1',
            'pagamento' => '1',
            'troco' => '600',
        ]);

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

        $itensPedido = \WebDelivery\Models\PedidoItem::create([
            'pedido_id' => $pedido->id,
            'produto_id' => $produto->id,
            'preco' => '666',
            'qtd' => '6',
            'meia' => '1',
            'obs' => 'testando pedido itens'
        ]);

        $itensPedido = \WebDelivery\Models\PedidoItem::find($itensPedido->id);
        $result = $pedido->itens[0];
        $this->assertEquals($itensPedido, $result);
    }

    public function test_atualizar_pedido()
    {
        $usuario = \WebDelivery\Models\User::create([
            'empresa_id' => 1,
            'nome' => 'Teste Usuário',
            'email' => 'teste@teste.com',
            'password' => bcrypt(123456),
            'tipo' => 'admin'
        ]);

        $cliente = \WebDelivery\Models\Cliente::create([
            'user_id' => $usuario->id,
            'telefone' => '(64)99252-8888',
            'endereco' => 'Rua 6',
            'bairro' => 'Conjunto Morada do Sol',
            'cep' => '75909-200',
            'cidade' => 'Rio Verde',
            'estado' => 'Goiás',
            'sexo' => 'M'
        ]);

        $pedido = \WebDelivery\Models\Pedido::create([
            'empresa_id' => 1,
            'cliente_id' => $cliente->id,
            'total' => '555',
            'retirada' => '1',
            'pagamento' => '1',
            'troco' => '600',
        ]);

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

        $itensPedido = \WebDelivery\Models\PedidoItem::create([
            'pedido_id' => $pedido->id,
            'produto_id' => $produto->id,
            'preco' => '666',
            'qtd' => '6',
            'meia' => '1',
            'obs' => 'testando pedido itens'
        ]);

        $pedido->total = 1;
        $pedido->save();

        $itensPedido->qtd = 50;
        $itensPedido->save();

        $this->seeInDatabase('pedidos', ['total' => 1]);
        $this->seeInDatabase('pedido_items', ['qtd' => 50]);
    }

    public function test_deletar_pedido()
    {
        $usuario = \WebDelivery\Models\User::create([
            'empresa_id' => 1,
            'nome' => 'Teste Usuário',
            'email' => 'teste@teste.com',
            'password' => bcrypt(123456),
            'tipo' => 'admin'
        ]);

        $cliente = \WebDelivery\Models\Cliente::create([
            'user_id' => $usuario->id,
            'telefone' => '(64)99252-8888',
            'endereco' => 'Rua 6',
            'bairro' => 'Conjunto Morada do Sol',
            'cep' => '75909-200',
            'cidade' => 'Rio Verde',
            'estado' => 'Goiás',
            'sexo' => 'M'
        ]);

        $pedido = \WebDelivery\Models\Pedido::create([
            'empresa_id' => 1,
            'cliente_id' => $cliente->id,
            'total' => '555',
            'retirada' => '1',
            'pagamento' => '1',
            'troco' => '600',
        ]);

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

        $itensPedido = \WebDelivery\Models\PedidoItem::create([
            'pedido_id' => $pedido->id,
            'produto_id' => $produto->id,
            'preco' => '666',
            'qtd' => '6',
            'meia' => '1',
            'obs' => 'testando pedido itens'
        ]);


        $pedido->delete();
        $itensPedido->delete();

        $this->assertNotEquals($pedido['deleted_at'], '');
        $this->assertNotEquals($itensPedido['deleted_at'], '');

    }

}
