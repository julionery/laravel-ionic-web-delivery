<?php

namespace WebDelivery\Transformers;

use League\Fractal\TransformerAbstract;
use WebDelivery\Models\User;

/**
 * Class UserTransformer
 * @package namespace WebDelivery\Transformers;
 */
class UserTransformer extends TransformerAbstract
{

    protected  $availableIncludes = ['cliente'];
    /**
     * Transform the \User entity
     * @param \User $model
     *
     * @return array
     */
    public function transform(User $model)
    {
        return [
            'id'         => (int) $model->id,
            'nome'       => (string) $model->nome,
            'email'      => (string) $model->email,
            'tipo'       => $model->tipo,
        ];
    }
    
    public function includeCliente(User $model){
        if ($model->cliente){
        return $this->item($model->cliente, new ClienteTransformer());
        }else{
            return null;
        }
    }
    
    
}
