<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginTest extends TestCase
{
    use DatabaseTransactions;

    public function test_login_cliente()
    {
        $this->visit("/")
            ->see("Login")
            ->click("Login")
            ->see("Não possui uma conta?")
            ->click("Não possui uma conta?")
            ->type('Teste Form', 'nome')
            ->type('julio@teste.com', 'email')
            ->type('123456', 'senha')
            ->type('123456', 'senha_confirmation')
            ->type('75909-190', 'cep')
            ->type('Rua Teste', 'endereco')
            ->type('(64)99252-6666', 'telefone')
            ->type('Morada do Sol', 'bairro')
            ->type('Rio Verde', 'cidade')
            ->type('Goiás', 'estado')
            ->press('Salvar')
            ->seePageIs("/auth/login");

        $this->visit("/auth/login")
            ->seePageIs("/auth/login")
            ->see("Entrar")
            ->type('julio@teste.com', 'email')
            ->type('123456', 'password')
            ->press("Entrar")
            ->seePageIs('/home')
            ->see('Painel Os PrintF')
            ->dontSee('Produtos')
            ->dontSee('Empresa');
    }

    public function test_login_admin()
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
            ->seePageIs("/auth/login")
            ->see("Entrar")
            ->type('teste@teste.com', 'email')
            ->type('666666', 'password')
            ->press("Entrar")
            ->seePageIs("/home")
            ->see('Painel Administrativo')
            ->see('Produtos')
            ->dontSee('Empresa');
}

    public function test_login_desenvolvedor()
    {
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
            ->press("Entrar")
            ->seePageIs("/home")
            ->see('Produtos')
            ->see('Empresa');
    }

    public function test_login_falha_validacao()
    {
        $this->visit("/auth/login")
            ->see("Entrar")
            ->type('teste@teste.com', 'email')
            ->type('666666', 'password')
            ->press("Entrar")
            ->seePageIs("/auth/login")
            ->hasFailed();
    }

}

