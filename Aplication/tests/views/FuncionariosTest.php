<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FuncionariosTest extends TestCase
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

    public function test_funcionarios_create()
    {
        $this->criando_usuario();

        $this->visit("/admin/entregadores")
            ->see("Novo Funcionário")
            ->click("Novo Funcionário")
            ->type("Testando Cliente", 'usuario[nome]')
            ->type("teste@teste.com", 'usuario[email]')
            ->type('75909-190', 'cep')
            ->type('Rua Teste', 'endereco')
            ->type('(64)99252-6666', 'telefone')
            ->type('Morada do Sol', 'bairro')
            ->type('Rio Verde', 'cidade')
            ->type('Goiás', 'estado')
            ->see("Criar Funcionário")
            ->see("Voltar");
    }

    public function test_funcionarios_update()
    {
        $this->criando_usuario();

        $this->visit("/admin/entregadores")
            ->see("entregadores/edit/")
            ->visit('/admin/entregadores/edit/1')
            ->type("Testando Funcionário", 'usuario[nome]')
            ->type("teste@teste.com", 'usuario[email]')
            ->type('75909-190', 'cep')
            ->type('Rua Teste', 'endereco')
            ->type('(64)99252-6666', 'telefone')
            ->type('Morada do Sol', 'bairro')
            ->type('Rio Verde', 'cidade')
            ->type('Goiás', 'estado')
            ->see("Salvar Funcionário")
            ->see("Voltar");
    }

    public function test_funcionarios_delete()
    {
        $this->criando_usuario();

        $this->visit("/admin/entregadores")
            ->see("entregadores/destroy/")
            ->visit('/admin/entregadores/destroy/1')
            ->see("Clientes");
    }

    public function test_funcionarios_relatorios()
    {
        $this->criando_usuario();

        $this->visit("/admin/entregadores")
            ->see("VISUALIZAR")
            ->see("DOWNLOAD");
    }
}

