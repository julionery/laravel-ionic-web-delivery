<?php

namespace WebDelivery\Transformers;

use League\Fractal\TransformerAbstract;
use WebDelivery\Models\Categoria;

/**
 * Class CategoriaTransformer
 * @package namespace WebDelivery\Transformers;
 */
class CategoriaTransformer extends TransformerAbstract
{

    /**
     * Transform the \Categoria entity
     * @param \Categoria $model
     *
     * @return array
     */
    public function transform(Categoria $model)
    {
        return [
            'id'         => (int) $model->id,
            'nome'       => (string) $model->nome,
            'empresa_id' => (int) $model->empresa_id,
        ];
    }
}
