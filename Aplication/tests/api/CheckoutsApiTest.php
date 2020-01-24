<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CheckoutsApiTest extends TestCase
{
    use DatabaseTransactions;

    public function test_api_pedidos()
    {
        $user = \WebDelivery\Models\User::find(1);

        $this->actingAs($user);

        //$this->get('api/cliente/pedido')->seeStatusCode(200);

        //$pedidos = $this->call('GET', 'api/cliente/pedido');

    }

}
