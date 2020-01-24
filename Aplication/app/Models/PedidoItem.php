<?php

namespace WebDelivery\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class PedidoItem extends Model implements Transformable
{
    use TransformableTrait;
    use SoftDeletes;
    
    protected $fillable = [
        'produto_id',
        'pedido_id',
        'preco',
        'qtd',
        'meia',
        'obs'
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    public function produto(){
        return $this->belongsTo(Produto::class);
    }

    public function componentes(){
        return $this->belongsToMany(Componente::class, 'produto_item_pedidos');
    }

    public function produtoItemsPedidos(){
        return $this->hasMany(ProdutoItemPedido::class);
    }

    public function empresa() {
        return $this->belongsTo(Empresa::class);
    }

}
