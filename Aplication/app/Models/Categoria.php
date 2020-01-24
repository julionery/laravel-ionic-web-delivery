<?php

namespace WebDelivery\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Categoria extends Model implements Transformable
{
    use TransformableTrait;
    use SoftDeletes;

    protected $fillable = [
        'empresa_id',
        'nome'
    ];

    public function produto(){
        return $this->hasMany(Produto::class);
    }

    public function empresa() {
        return $this->belongsTo(Empresa::class);
    }

}
