<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RegistroTest extends TestCase
{
    use DatabaseTransactions;

    public function test_create_user_using_form()
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
            ->type('6', 'lote')
            ->type('15', 'quadra')
            ->type('991', 'numero')
            ->press('Salvar');

            $this->seeInDatabase('usuarios', ['nome'=> 'Teste Form']);
            $this->seeInDatabase('clientes', ['cep' => '75909-190']);
    }

}

