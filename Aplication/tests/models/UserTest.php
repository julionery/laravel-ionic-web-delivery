<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    //criando usuário
    public function test_criar_usuario()
    {
        \WebDelivery\Models\User::create([
            'empresa_id' => 1,
            'nome' => 'Teste Usuário',
            'email' => 'teste@teste.com',
            'password' => bcrypt(123456),
            'tipo' => 'admin'
        ]);

        $this->seeInDatabase('usuarios', ['nome' => 'Teste Usuário']);
    }

    //criando usuário com dados do cliente
    public function test_criar_usuario_perfil()
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
            'telefone' => '(64)99252-2131',
            'endereco' => 'Rua 6',
            'bairro' => 'Conjunto Morada do Sol',
            'cep' => '75909-200',
            'cidade' => 'Rio Verde',
            'estado' => 'Goiás',
            'sexo' => 'M'
        ]);

        $this->seeInDatabase('usuarios', ['nome' => 'Teste Usuário']);
        $this->seeInDatabase('clientes', [
            'user_id' => $usuario->id,
            'endereco' => 'Rua 6'
        ]);
    }

    //testando cliente pelo usuário
    public function test_get_cliente_by_usuario()
    {
        $usuario = \WebDelivery\Models\User::create([
            'empresa_id' => 1,
            'nome' => 'Teste Usuário',
            'email' => 'teste@teste.com',
            'password' => bcrypt(123456),
            'tipo' => 'admin'
        ]);

        $usuarioPerfil = \WebDelivery\Models\Cliente::create([
            'user_id' => $usuario->id,
            'telefone' => '(64)99252-2131',
            'endereco' => 'Rua 6',
            'bairro' => 'Conjunto Morada do Sol',
            'cep' => '75909-200',
            'cidade' => 'Rio Verde',
            'estado' => 'Goiás',
            'sexo' => 'M'
        ]);

        $usuarioPerfil = \WebDelivery\Models\Cliente::find($usuarioPerfil->id);
        $result = $usuario->cliente;
        $this->assertEquals($usuarioPerfil, $result);
    }

    public function test_atualizar_usuario()
    {
        $usuario = \WebDelivery\Models\User::create([
            'empresa_id' => 1,
            'nome' => 'Teste Usuário',
            'email' => 'teste@teste.com',
            'password' => bcrypt(123456),
            'tipo' => 'admin'
        ]);

        $usuario->nome = 'Julio Teste';

        $usuario->save();

        $this->seeInDatabase('usuarios', ['nome' => 'Julio Teste']);
    }

    public function test_deletar_usuario()
    {
        $usuario = \WebDelivery\Models\User::create([
            'empresa_id' => 1,
            'nome' => 'Teste Usuário',
            'email' => 'teste@teste.com',
            'password' => bcrypt(123456),
            'tipo' => 'admin'
        ]);

        $usuario->delete();

        $this->assertNotEquals($usuario['deleted_at'], '');
    }

}
