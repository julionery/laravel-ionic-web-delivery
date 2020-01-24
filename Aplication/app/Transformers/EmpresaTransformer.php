<?php

namespace WebDelivery\Transformers;

use League\Fractal\TransformerAbstract;
use WebDelivery\Models\Empresa;

/**
 * Class EmpresaTransformer
 * @package namespace WebDelivery\Transformers;
 */
class EmpresaTransformer extends TransformerAbstract
{

    /**
     * Transform the \Empresa entity
     * @param \Empresa $model
     *
     * @return array
     */
    public function transform(Empresa $model)
    {
        return [
            'id'                => (int) $model->id,
            'nome_fantasia'     => (string) $model->nome_fantasia,
            'telefone'          => (string) $model->telefone,
            'endereco'          => (string) $model->endereco,
            'bairro'            => (string) $model->bairro,
            'cidade'            => (string) $model->cidade,
            'estado'            => (string) $model->estado,
            'cep'            => (string) $model->cep,
            'abertura'          => $model->abertura,
            'fechamento'        => $model->fechamento,
            'status'            => (int) $model->status,
            'consumacao_minima' => (int) $model->consumacao_minima,
        ];
    }
}
