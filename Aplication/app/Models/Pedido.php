<?php

namespace WebDelivery\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Pedido extends Model implements Transformable
{
    use TransformableTrait;
    use SoftDeletes;
    
    protected $fillable = [
        'empresa_id',
        'cliente_id',
        'usuario_entregador_id',
        'total',
        'status',
        'retirada',
        'pagamento',
        'troco',
        'cupom_id'
    ];

    public function transform(){
        return [
            'pedido' => $this->id,
            'pedido_items' => $this->itens
        ];
    }

    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }

    public function cupom(){
        return $this->belongsTo(Cupom::class);
    }

    public function itens(){
        return $this->hasMany(PedidoItem::class);
    }

    public function entregador() {
        return $this->belongsTo(User::class, 'usuario_entregador_id', 'id');
    }

    public function empresa() {
        return $this->belongsTo(Empresa::class);
    }

}
