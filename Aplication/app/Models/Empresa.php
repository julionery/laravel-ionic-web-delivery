<?php

namespace WebDelivery\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Empresa extends Model implements Transformable
{
    use TransformableTrait;
    use SoftDeletes;
    
    protected $fillable = [
        'razao_social',
        'nome_fantasia',
        'cnpj',
        'telefone',
        'endereco',
        'bairro',
        'cidade',
        'estado',
        'cep',
        'logo',
        'consumacao_minima',
        'abertura',
        'fechamento',
        'status',
        'emailPedidos'
    ];

    public function produto(){
        return $this->hasMany(Produto::class);
    }

    public function categoria(){
        return $this->hasMany(Categoria::class);
    }

    public function usuario(){
        return $this->hasMany(User::class);
    }

}
