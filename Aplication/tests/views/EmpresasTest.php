<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EmpresasTest extends TestCase
{
    use DatabaseTransactions;

    public function criando_usuario(){
        $usuario = \WebDelivery\Models\User::create([
            'empresa_id' => 1,
            'nome' => 'Teste Usuário',
            'email' => 'teste@teste.com',
            'password' => bcrypt(666666),
        ]);
        $usuario->tipo = 'desenvolvedor';
        $usuario->save();

        $this->visit("/auth/login")
            ->see("Entrar")
            ->type('teste@teste.com', 'email')
            ->type('666666', 'password')
            ->press("Entrar");
    }

    public function test_empresas_create()
    {
        $this->criando_usuario();

        $this->visit("/admin/empresas")
            ->see("Nova Empresa")
            ->click("Nova Empresa")
            ->type("Testando Empresa", 'cnpj')
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
            ->see("Criar Empresa")
            ->see("Voltar");
    }

    public function test_empresas_update()
    {
        $this->criando_usuario();

        $this->visit("/admin/empresas")
            ->see("empresas/edit/")
            ->visit('/admin/empresas/edit/1')
            ->type("Testando Empresa", 'cnpj')
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
            ->see("Salvar Empresa")
            ->see("Voltar");
    }

    public function test_empresas_delete()
    {
        $this->criando_usuario();

        $this->visit("/admin/empresas")
            ->see("empresas/destroy/")
            ->visit('/admin/empresas/destroy/1')
            ->see("Empresas");
    }

    public function test_empresas_relatorios()
    {
        $this->criando_usuario();

        $this->visit("/admin/empresas")
            ->see("VISUALIZAR")
            ->see("DOWNLOAD");
    }
}

