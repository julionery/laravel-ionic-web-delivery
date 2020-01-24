<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ClienteTest extends TestCase
{
    use DatabaseTransactions;

    //criando cliente
    public function test_criar_cliente()
    {
        $usuario = \WebDelivery\Models\User::create([
            'empresa_id' => 1,
            'nome' => 'Teste Usuário',
            'email' => 'teste@teste.com',
            'password' => bcrypt(123456),
            'tipo' => 'admin'
        ]);

        \WebDelivery\Models\Cliente::create([
            'user_id' => $usuario->id,
            'telefone' => '(64)99252-8888',
            'endereco' => 'Rua 6',
            'bairro' => 'Conjunto Morada do Sol',
            'cep' => '75909-200',
            'cidade' => 'Rio Verde',
            'estado' => 'Goiás',
            'sexo' => 'M'
        ]);

        $this->seeInDatabase('clientes', ['telefone' => '(64)99252-8888']);
    }

    //listando cliente
    public function test_listar_cliente()
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

        $buscaCliente = \WebDelivery\Models\Cliente::find($cliente->id);

        $this->assertNotEquals($buscaCliente, '');
    }

    //atualizando cliente
    public function test_atualizar_cliente()
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

        $cliente->endereco = 'Teste Atualizando Cliente';

        $cliente->save();

        $this->seeInDatabase('clientes', ['endereco' => 'Teste Atualizando Cliente']);
    }

    //deletando cliente
    public function test_deletar_cliente()
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

        $cliente->delete();

        $this->assertNotEquals($cliente['deleted_at'], '');
    }
}
