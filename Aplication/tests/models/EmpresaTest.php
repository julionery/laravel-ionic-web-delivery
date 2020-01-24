<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EmpresaTest extends TestCase
{
    use DatabaseTransactions;

    //criando empresa
    public function test_criar_empresa()
    {
        \WebDelivery\Models\Empresa::create([
            'razao_social' => 'Os PrintF Desenvolvimento',
            'nome_fantasia' => 'Os PrintF',
            'cnpj' => '33.333.333/3333-33',
            'telefone' => '(64) 3612-1884',
            'endereco' => 'Rua 75 Q 41, s/n Lt 4',
            'bairro' => 'Popular',
            'cidade' => 'Rio Verde',
            'estado' => 'Goiás',
            'cep' => '75900-000',
            'consumacao_minima' => '5',
            'abertura' => '00:00',
            'fechamento' => '23:59',
            'status' => '1',
            'emailPedidos' => 'teste@teste.com'
        ]);

        $this->seeInDatabase('empresas', ['nome_fantasia' => 'Os PrintF']);
    }

    //listando empresa
    public function test_listar_empresa()
    {
        $empresa = \WebDelivery\Models\Empresa::create([
            'razao_social' => 'Os PrintF Desenvolvimento',
            'nome_fantasia' => 'Os PrintF',
            'cnpj' => '33.333.333/3333-33',
            'telefone' => '(64) 3612-1884',
            'endereco' => 'Rua 75 Q 41, s/n Lt 4',
            'bairro' => 'Popular',
            'cidade' => 'Rio Verde',
            'estado' => 'Goiás',
            'cep' => '75900-000',
            'consumacao_minima' => '5',
            'abertura' => '00:00',
            'fechamento' => '23:59',
            'status' => '1',
            'emailPedidos' => 'teste@teste.com'
        ]);

        $buscaEmpresa = \WebDelivery\Models\Empresa::find($empresa->id);

        $this->assertNotEquals($buscaEmpresa, '');
    }

    //atualizando empresa
    public function test_atualizar_empresa()
    {
        $empresa = \WebDelivery\Models\Empresa::create([
            'razao_social' => 'Os PrintF Desenvolvimento',
            'nome_fantasia' => 'Os PrintF',
            'cnpj' => '33.333.333/3333-33',
            'telefone' => '(64) 3612-1884',
            'endereco' => 'Rua 75 Q 41, s/n Lt 4',
            'bairro' => 'Popular',
            'cidade' => 'Rio Verde',
            'estado' => 'Goiás',
            'cep' => '75900-000',
            'consumacao_minima' => '5',
            'abertura' => '00:00',
            'fechamento' => '23:59',
            'status' => '1',
            'emailPedidos' => 'teste@teste.com'
        ]);

        $empresa->razao_social = 'Teste Atualizando Empresa';

        $empresa->save();

        $this->seeInDatabase('empresas', ['razao_social' => 'Teste Atualizando Empresa']);
    }

    //deletando empresa
    public function test_deletar_empresa()
    {
        $empresa = \WebDelivery\Models\Empresa::create([
            'razao_social' => 'Os PrintF Desenvolvimento',
            'nome_fantasia' => 'Os PrintF',
            'cnpj' => '33.333.333/3333-33',
            'telefone' => '(64) 3612-1884',
            'endereco' => 'Rua 75 Q 41, s/n Lt 4',
            'bairro' => 'Popular',
            'cidade' => 'Rio Verde',
            'estado' => 'Goiás',
            'cep' => '75900-000',
            'consumacao_minima' => '5',
            'abertura' => '00:00',
            'fechamento' => '23:59',
            'status' => '1',
            'emailPedidos' => 'teste@teste.com'
        ]);

        $empresa->delete();

        $this->assertNotEquals($empresa['deleted_at'], '');
    }
}
