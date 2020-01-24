<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class IngredientesTest extends TestCase
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

    public function test_ingredientes_create()
    {
        $this->criando_usuario();

        $this->visit("/admin/ingredientes")
            ->see("Novo Ingrediente")
            ->click("Novo Ingrediente")
            ->type("Testando ingredientes", 'nome')
            ->see("Criar Ingrediente")
            ->see("Voltar");
    }

    public function test_ingredientes_update()
    {
        $this->criando_usuario();

        $this->visit("/admin/ingredientes")
            ->see("ingredientes/edit/")
            ->visit('/admin/ingredientes/edit/1')
            ->type("Testando ingredientes", 'nome')
            ->see("Salvar Ingrediente")
            ->see("Voltar");
    }

    public function test_ingredientes_delete()
    {
        $this->criando_usuario();

        $this->visit("/admin/ingredientes")
            ->see("ingredientes/destroy/")
            ->visit('/admin/ingredientes/destroy/1')
            ->see("Ingredientes");
    }

    public function test_ingredientes_relatorios()
    {
        $this->criando_usuario();

        $this->visit("/admin/ingredientes")
            ->see("VISUALIZAR")
            ->see("DOWNLOAD");
    }
}

