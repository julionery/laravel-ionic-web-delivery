<?php

namespace WebDelivery\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Componente extends Model implements Transformable
{
    use TransformableTrait;
    use SoftDeletes;

    protected $fillable = [
        'empresa_id',
        'nome',
        'descricao',
        'preco',
        'tipo'
    ];

    public function empresa() {
        return $this->belongsTo(Empresa::class);
    }

    public function produtoItem() {
        return $this->hasMany(ProdutoItem::class);
    }

    public function produto(){
        return $this->belongsToMany(Produto::class, 'produto_items');
    }

    public function produtoItemsPedidos(){
        return $this->hasMany(ProdutoItemPedido::class);
    }

    public function pedidoItems(){
        return $this->belongsToMany(PedidoItem::class, 'produto_item_pedidos');
    }

}
