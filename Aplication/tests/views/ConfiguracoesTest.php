<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ConfiguracoesTest extends TestCase
{
    use DatabaseTransactions;

    public function criando_usuario(){
        $usuario = \WebDelivery\Models\User::create([
            'empresa_id' => 1,
            'nome' => 'Teste Usuário',
            'email' => 'teste@teste.com',
            'password' => bcrypt(666666),
        ]);
        $usuario->tipo = 'admin';
        $usuario->save();

        $this->visit("/auth/login")
            ->see("Entrar")
            ->type('teste@teste.com', 'email')
            ->type('666666', 'password')
            ->press("Entrar");
    }

    public function test_configuracoes()
    {
        $this->criando_usuario();

        $this->visit("/admin/configuracoes")
            ->see("Empresa")
            ->type("Testando Cliente", 'cnpj')
            ->type("teste@teste.com", 'razao_social')
            ->type("teste@teste.com", 'nome_fantasia')
            ->type('75909-190', 'cep')
            ->type('Rua Teste', 'endereco')
            ->type('(64)99252-6666', 'telefone')
            ->type('Morada do Sol', 'bairro')
            ->type('Rio Verde', 'cidade')
            ->type('Goiás', 'estado')
            ->type('11:30', 'abertura')
            ->type('16:30', 'fechamento')
            ->type(10, 'consumacao_minima')
            ->type('teste@teste.com', 'emailPedidos')
            ->see("Salvar")
            ->see("Voltar");
    }
}

