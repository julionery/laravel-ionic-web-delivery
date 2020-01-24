<?php

namespace WebDelivery\Transformers;

use League\Fractal\TransformerAbstract;
use WebDelivery\Models\Componente;

/**
 * Class ComponenteTransformer
 * @package namespace WebDelivery\Transformers;
 */
class ComponenteTransformer extends TransformerAbstract
{

    /**
     * Transform the \Componente entity
     * @param \Componente $model
     *
     * @return array
     */
    public function transform(Componente $model)
    {
        return [
            'id'         => (int) $model->id,
            'nome'       => (string) $model->nome,
            'descricao'  => (string) $model->descricao,
            'tipo'       => $model ->tipo,
            'preco'      => $model ->preco,
            'empresa_id' => (int) $model->empresa_id,
        ];
    }
}
