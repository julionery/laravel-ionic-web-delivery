<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PedidosTest extends TestCase
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

    public function test_pedidos()
    {
        $this->criando_usuario();

        $this->visit("/admin/pedidos")
            ->see("Pedidos");
    }

    public function test_pedidos_update()
    {
        $this->criando_usuario();

        $this->visit("/admin/pedidos")
            ->see("pedidos/")
            ->visit('/admin/pedidos/1')
            ->see("Pedido #")
            ->see("Salvar")
            ->see("Voltar");
    }

    public function test_pedidos_relatorios()
    {
        $this->criando_usuario();

        $this->visit("/admin/pedidos")
            ->see("VISUALIZAR")
            ->see("DOWNLOAD");
    }
}

