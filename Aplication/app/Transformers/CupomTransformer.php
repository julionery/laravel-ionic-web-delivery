<?php

namespace WebDelivery\Transformers;

use League\Fractal\TransformerAbstract;
use WebDelivery\Models\Cupom;

/**
 * Class CupomTransformer
 * @package namespace WebDelivery\Transformers;
 */
class CupomTransformer extends TransformerAbstract
{

    /**
     * Transform the \Cupom entity
     * @param \Cupom $model
     *
     * @return array
     */
    public function transform(Cupom $model)
    {
        return [
            'id'         => (int) $model->id,
            'empresa_id' => (int) $model->empresa_id,
            'codigo'     => $model->codigo,
            'valor'      => (float) $model->valor,
        ];
    }
}
