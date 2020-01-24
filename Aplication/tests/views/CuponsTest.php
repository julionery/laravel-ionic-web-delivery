<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CuponsTest extends TestCase
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

    public function test_cupoms_create()
    {
        $this->criando_usuario();

        $this->visit("/admin/cupoms")
            ->see("Novo Cupom")
            ->click("Novo Cupom")
            ->type('12345', 'codigo')
            ->type(12, 'valor')
            ->see("Criar Cupom")
            ->see("Voltar");;
    }

    public function test_cupoms_update()
    {
        $this->criando_usuario();

        $this->visit("/admin/cupoms")
            ->see("cupoms/edit/")
            ->visit('/admin/cupoms/edit/1')
            ->type("54321", 'codigo')
            ->type(12, 'valor')
            ->see("Salvar Cupom")
            ->see("Voltar");
    }

    public function test_cupoms_delete()
    {
        $this->criando_usuario();

        $this->visit("/admin/cupoms")
            ->see("cupoms/destroy/")
            ->visit('/admin/cupoms/destroy/1')
            ->see("Cupom");
    }

    public function test_cupoms_relatorios()
    {
        $this->criando_usuario();

        $this->visit("/admin/cupoms")
            ->see("VISUALIZAR")
            ->see("DOWNLOAD");
    }
}

