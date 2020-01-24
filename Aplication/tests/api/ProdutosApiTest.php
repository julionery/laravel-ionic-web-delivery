<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProdutosApiTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;

    public function test_api_produtos()
    {
        $this->get('api/cliente/produtos/1')->seeStatusCode(200);
        //$produtos = $this->call('GET', 'api/cliente/produtos/1');
    }

}
