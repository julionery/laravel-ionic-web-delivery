<?php

namespace WebDelivery\Transformers;

use League\Fractal\TransformerAbstract;
use WebDelivery\Models\Produto;

/**
 * Class ProdutoTransformer
 * @package namespace WebDelivery\Transformers;
 */
class ProdutoTransformer extends TransformerAbstract
{

    protected $defaultIncludes = ['componentes'];
    /**
     * Transform the \Produto entity
     * @param \Produto $model
     *
     * @return array
     */
    public function transform(Produto $model)
    {
        return [
            'id'           => (int) $model->id,
            'nome'         => (string) $model->nome,
            'descricao'    => (string) $model->descricao,
            'tamanho'      => $model->tamanho,
            'preco'        => $model->preco,
            'empresa_id'   => (int) $model->empresa_id,
            'categoria_id' => (int) $model->categoria_id,
            'permiteAdicionais'   => $model->adicionais
        ];
    }

    public function includeComponentes(Produto $model){
        return $this->collection($model->componentes, new ComponenteTransformer());
    }
}
