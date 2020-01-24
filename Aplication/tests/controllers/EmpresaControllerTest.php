<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EmpresaControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function criando_usuario()
    {
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

    //listando Categoria
    public function test_listar_categoriaController()
    {
        $this->criando_usuario();

        $this->visit('/admin/categorias')
            ->seePageIs('/admin/categorias');

    }

    //criando Categoria
    public function test_create_categoriaController()
    {
        $this->criando_usuario();

        $this->visit('/admin/categorias/create')
            ->seePageIs('/admin/categorias/create');
    }

    //adicionando Categoria
    public function test_store_categoriaController()
    {
        $this->criando_usuario();

        $this->visit('/admin/categorias/create')
            ->seePageIs('/admin/categorias/create')
            ->see("Criar Categoria")
            ->type('Teste Categoria', 'nome');
        //    ->submitForm("Criar Categoria");

        //$this->seeInDatabase('categorias', [
        //         'nome' => 'Teste Categoria'
        //    ]);
    }

    public function test_update_categoriaController()
    {
        //$this->criando_usuario();

        //$data = [
        //   'nome' => 'Update Categoria'
        //];

        //$this->post('/admin/categorias/edit/1', $data)
        //    ->see('Cdsasasdasdasd');
    }
    
    //deletando Categoria
    public function test_deletar_categoriaController()
    {
        $this->criando_usuario();

        $this->visit('/admin/categorias/destroy/1')
            ->seePageIs('/admin/categorias');
    }

}
