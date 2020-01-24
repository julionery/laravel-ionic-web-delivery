<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdicionaisTest extends TestCase
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
            ->type('teste@teste.com', 'email')
            ->type('666666', 'password')
            ->press("Entrar");
    }

    public function test_adicionais_create()
    {
        $this->criando_usuario();

        $this->visit("/admin/componentes")
            ->seePageIs("/admin/componentes")
            ->see("Novo Adicional")
            ->click("Novo Adicional")
            ->seePageIs("/admin/componentes/create")
            ->type("Testando Adicional", 'nome')
            ->type(15, 'preco')
            ->type("Teste Descrição", 'descricao')
            ->see("Criar Adicional")
            ->see("Voltar");
    }

    public function test_adicionais_update()
    {
        $this->criando_usuario();

        $this->visit("/admin/componentes")
            ->see("componentes/edit/")
            ->visit('/admin/componentes/edit/1')
            ->type("Testando Adicional", 'nome')
            ->type(15, 'preco')
            ->type("Teste Descrição", 'descricao')
            ->see("Salvar Adicional")
            ->see("Voltar");
    }

    public function test_adicionais_delete()
    {
        $this->criando_usuario();

        $this->visit("/admin/componentes")
            ->see("componentes/destroy/")
            ->visit('/admin/componentes/destroy/1')
            ->see("Adicionais");
    }

    public function test_adicionais_relatorios()
    {
        $this->criando_usuario();

        $this->visit("/admin/componentes")
            ->see("VISUALIZAR")
            ->see("DOWNLOAD");
    }
}

