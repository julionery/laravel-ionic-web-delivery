<?php

namespace WebDelivery\Transformers;

use League\Fractal\TransformerAbstract;
use WebDelivery\Models\Cliente;

/**
 * Class ClienteTransformer
 * @package namespace WebDelivery\Transformers;
 */
class ClienteTransformer extends TransformerAbstract
{

    protected $defaultIncludes = ['user'];

    /**
     * Transform the \Cliente entity
     * @param \Cliente $model
     *
     * @return array
     */
    public function transform(Cliente $model)
    {
        return [
            'id'         => (int) $model->id,
            'telefone'   => (string) $model->telefone,
            'endereco'   => (string) $model->endereco,
            'bairro'     => (string) $model->bairro,
            'cep'        => (string) $model->cep,
            'cidade'     => (string) $model->cidade,
            'estado'     => (string) $model->estado,
        ];
    }

    public function includeUser(Cliente $model){
        return $this->item($model->usuario, new UserTransformer());
    }
}
