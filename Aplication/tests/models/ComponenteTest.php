<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ComponenteTest extends TestCase
{
    use DatabaseTransactions;

    //criando componente
    public function test_criar_componente()
    {
        \WebDelivery\Models\Componente::create([
            'empresa_id' => 1,
            'nome' => 'Teste'
        ]);

        $this->seeInDatabase('componentes', ['nome' => 'Teste']);
    }

    //listando componente
    public function test_listar_componente()
    {
        $componente = \WebDelivery\Models\Componente::create([
            'empresa_id' => 1,
            'nome' => 'Teste',
            'descricao' => 'Testando Componentes',
            'preco' => '5',
            'tipo' => 'A'
        ]);

        $buscaComponente = \WebDelivery\Models\Componente::find($componente->id);

        $this->assertNotEquals($buscaComponente, '');
    }

    //atualizando componente
    public function test_atualizar_componente()
    {
        $componente = \WebDelivery\Models\Componente::create([
            'empresa_id' => 1,
            'nome' => 'Teste Componente',
            'descricao' => 'Testando Componentes',
            'preco' => '5',
            'tipo' => 'A'
        ]);

        $componente->nome = 'Teste Atualizando Componente';

        $componente->save();

        $this->seeInDatabase('componentes', ['nome' => 'Teste Atualizando Componente']);
    }

    //deletando componente
    public function test_deletar_componente()
    {
        $componente = \WebDelivery\Models\Componente::create([
            'empresa_id' => 1,
            'nome' => 'Teste Componente',
            'descricao' => 'Testando Componentes',
            'preco' => '15',
            'tipo' => 'I'
        ]);

        $componente->delete();

        $this->assertNotEquals($componente['deleted_at'], '');
    }
}
