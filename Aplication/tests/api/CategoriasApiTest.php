<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CategoriasApiTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;

    public function test_api_categorias()
    {
        $this->get('api/cliente/categorias/1')->seeStatusCode(200);
        //$categorias = $this->call('GET', 'api/cliente/categorias/2');
    }

}
