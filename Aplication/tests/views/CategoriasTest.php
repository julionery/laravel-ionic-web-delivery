<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CategoriasTest extends TestCase
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

    public function test_categorias_create()
    {
        $this->criando_usuario();

        $this->visit("/admin/categorias")
            ->see("Nova Categoria")
            ->click("Nova Categoria")
            ->type("Testando Categoria", 'nome')
            ->see("Criar Categoria")
            ->see("Voltar");;
    }

    public function test_categorias_update()
    {
        $this->criando_usuario();

        $this->visit("/admin/categorias")
            ->see("categorias/edit/")
            ->visit('/admin/categorias/edit/1')
            ->type("Testando Categorias", 'nome')
            ->see("Salvar Categoria")
            ->see("Voltar");
    }

    public function test_categorias_delete()
    {
        $this->criando_usuario();

        $this->visit("/admin/categorias")
            ->see("categorias/destroy/")
            ->visit('/admin/categorias/destroy/1')
            ->see("Categorias");
    }

    public function test_categorias_relatorios()
    {
        $this->criando_usuario();

        $this->visit("/admin/categorias")
            ->see("VISUALIZAR")
            ->see("DOWNLOAD");
    }
}

