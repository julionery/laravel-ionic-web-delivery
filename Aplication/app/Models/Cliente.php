<?php

namespace WebDelivery\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Cliente extends Model implements Transformable
{
    use TransformableTrait;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'telefone',
        'endereco',
        'bairro',
        'cep',
        'cidade',
        'estado',
        'sexo',
        'placa',
        'modelo',
    ];

    public function usuario()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

}
