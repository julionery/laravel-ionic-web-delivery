<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdicionaisApiTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;

    public function test_api_adicionais()
    {
        $this->get('api/cliente/adicionais/1')->seeStatusCode(200);
        //$adicionais = $this->call('GET', 'api/cliente/adicionais/2');
    }

}
