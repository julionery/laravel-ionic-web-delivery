<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ClientesTest extends TestCase
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

    public function test_clientes_create()
    {
        $this->criando_usuario();

        $this->visit("/admin/clientes")
            ->see("Novo Cliente")
            ->click("Novo Cliente")
            ->type("Testando Cliente", 'usuario[nome]')
            ->type("teste@teste.com", 'usuario[email]')
            ->type('75909-190', 'cep')
            ->type('Rua Teste', 'endereco')
            ->type('(64)99252-6666', 'telefone')
            ->type('Morada do Sol', 'bairro')
            ->type('Rio Verde', 'cidade')
            ->type('Goiás', 'estado')
            ->see("Criar Cliente")
            ->see("Voltar");
    }

    public function test_clientes_update()
    {
        $this->criando_usuario();

        $this->visit("/admin/clientes")
            ->see("clientes/edit/")
            ->visit('/admin/clientes/edit/1')
            ->type("Testando Cliente", 'usuario[nome]')
            ->type("teste@teste.com", 'usuario[email]')
            ->type('75909-190', 'cep')
            ->type('Rua Teste', 'endereco')
            ->type('(64)99252-6666', 'telefone')
            ->type('Morada do Sol', 'bairro')
            ->type('Rio Verde', 'cidade')
            ->type('Goiás', 'estado')
            ->see("Salvar Cliente")
            ->see("Voltar");
    }

    public function test_clientes_delete()
    {
        $this->criando_usuario();

        $this->visit("/admin/clientes")
            ->see("clientes/destroy/")
            ->visit('/admin/clientes/destroy/1')
            ->see("Clientes");
    }

    public function test_clientes_relatorios()
    {
        $this->criando_usuario();

        $this->visit("/admin/clientes")
            ->see("VISUALIZAR")
            ->see("DOWNLOAD");
    }
}

