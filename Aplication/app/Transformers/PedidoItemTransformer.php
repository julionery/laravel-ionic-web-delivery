<?php

namespace WebDelivery\Transformers;

use League\Fractal\TransformerAbstract;
use WebDelivery\Models\PedidoItem;

/**
 * Class PedidoItemTransformer
 * @package namespace WebDelivery\Transformers;
 */
class PedidoItemTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['produtos', 'componentes'];
    /**
     * Transform the \PedidoItem entity
     * @param \PedidoItem $model
     *
     * @return array
     */
    public function transform(PedidoItem $model)
    {
        return [
            'id'         => (int) $model->id,
            'preco'      => $model->preco,
            'qtd'        => (int) $model->qtd,
            'meia'       => (int) $model->meia,
            'obs'        => $model->obs,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }

    public function includeProdutos(PedidoItem $model)
    {
        return $this->item($model->produto, new ProdutoTransformer());
    }

    public function includeComponentes(PedidoItem $model)
    {
        return $this->collection($model->componentes, new ComponenteTransformer());
    }

}
