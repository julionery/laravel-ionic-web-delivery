<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EmpresasApiTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;

    public function test_api_empresas()
    {
        $this->get('api/cliente/empresas')->seeStatusCode(200);
        //$empresas = $this->call('GET', 'api/cliente/empresas');
    }

}
