<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProdutosTest extends TestCase
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

    public function test_produtos_create()
    {
        $this->criando_usuario();

        $this->visit("/admin/produtos")
            ->see("Novo Produto")
            ->click("Novo Produto")
            ->type("Testando Produto", 'nome')
            ->type(15, 'preco')
            ->type("Teste Descrição", 'descricao')
            ->see("Criar Produto")
            ->see("Voltar");
    }

    public function test_produtos_update()
    {
        $this->criando_usuario();

        $this->visit("/admin/produtos")
            ->see("produtos/edit/")
            ->visit('/admin/produtos/edit/1')
            ->type("Testando Produto", 'nome')
            ->type(15, 'preco')
            ->type("Teste Produto", 'descricao')
            ->see("Salvar Produto")
            ->see("Voltar");
    }

    public function test_produtos_clonar()
    {
        $this->criando_usuario();

        $this->visit("/admin/produtos")
            ->see("produtos/clonar/")
            ->visit('/admin/produtos/clonar/1')
            ->type("Testando Produto", 'nome')
            ->type(15, 'preco')
            ->type("Teste Produto", 'descricao')
            ->see("Salvar Produto")
            ->see("Voltar");
    }

    public function test_produtos_delete()
    {
        $this->criando_usuario();

        $this->visit("/admin/produtos")
            ->see("produtos/destroy/")
            ->visit('/admin/produtos/destroy/1')
            ->see("Produtos");
    }

    public function test_produtos_relatorios()
    {
        $this->criando_usuario();

        $this->visit("/admin/produtos")
            ->see("VISUALIZAR")
            ->see("DOWNLOAD");
    }
}

