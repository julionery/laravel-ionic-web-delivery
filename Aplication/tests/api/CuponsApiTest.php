<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CuponsApiTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;

    public function test_api_cupons()
    {
        \WebDelivery\Models\Cupom::create([
            'empresa_id' => 1,
            'codigo' => '12345',
            'valor' => 30
        ]);

        $this->get('api/cupom/12345')->seeStatusCode(200);

        $cupom = \WebDelivery\Models\Cupom::create([
            'empresa_id' => 1,
            'codigo' => '54321',
            'valor' => 30
        ]);

        $cupom['usado'] = 1;
        $cupom->save();

        $this->get('api/cupom/54321')->seeStatusCode(404);

        //$cupom = $this->call('GET', 'api/cupom/54321');
    }

}
