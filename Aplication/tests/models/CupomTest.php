<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CupomTest extends TestCase
{
    use DatabaseTransactions;

    //criando cupom
    public function test_criar_cupom()
    {
        \WebDelivery\Models\Cupom::create([
            'empresa_id' => 1,
            'codigo' => '12345',
            'valor' => 30
        ]);

        $this->seeInDatabase('cupoms', ['codigo' => '12345']);
    }

    //listando cupom
    public function test_listar_cupom()
    {
        $cupom = \WebDelivery\Models\Cupom::create([
            'empresa_id' => 1,
            'codigo' => '12345',
            'valor' => 30
        ]);

        $buscaCupom = \WebDelivery\Models\Cupom::find($cupom->id);

        $this->assertNotEquals($buscaCupom, '');
    }

    //atualizando cupom
    public function test_atualizar_cupom()
    {
        $cupom = \WebDelivery\Models\Cupom::create([
            'empresa_id' => 1,
            'codigo' => '12345',
            'valor' => 30
        ]);

        $cupom->valor = 55;

        $cupom->save();

        $this->seeInDatabase('cupoms', ['valor' => 55]);
    }

    //deletando cupom
    public function test_deletar_cupom()
    {
        $cupom = \WebDelivery\Models\Cupom::create([
            'empresa_id' => 1,
            'codigo' => '12345',
            'valor' => 30
        ]);

        $cupom->delete();
        $this->assertNotEquals($cupom['deleted_at'], '');
    }
}
