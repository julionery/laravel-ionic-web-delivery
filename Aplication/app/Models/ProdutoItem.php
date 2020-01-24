<?php

namespace WebDelivery\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ProdutoItem extends Model implements Transformable
{
    use TransformableTrait;
    use SoftDeletes;
    
    protected $fillable = [
        'produto_id',
        'componente_id'
    ];

    public function produto(){
        return $this->hasMany(Produto::class);
    }

    public function componentes() {
        return $this->hasMany(Componente::class);
    }

}
