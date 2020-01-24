<?php

namespace WebDelivery\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ProdutoItemPedido extends Model implements Transformable
{
    use TransformableTrait;
    use SoftDeletes;
    
    protected $fillable = [
        'componente_id',
        'pedido_item_id',
    ];

}
