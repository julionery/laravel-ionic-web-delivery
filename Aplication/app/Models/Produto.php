<?php

namespace WebDelivery\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Produto extends Model implements Transformable
{
    use TransformableTrait;
    use SoftDeletes;
    
    protected $fillable = [
        'empresa_id',
        'categoria_id',
        'nome',
        'descricao',
        'tamanho',
        'preco',
        'imagem',
        'adicionais'
    ];

    public function categoria() {
        return $this->belongsTo(Categoria::class);
    }

    public function empresa() {
        return $this->belongsTo(Empresa::class);
    }

    public function componentes(){
        return $this->belongsToMany(Componente::class, 'produto_items');
    }
    
    public function getComponenteListAttribute(){
        $componentes = $this->componentes()->lists('nome')->all();
        return implode(', ', $componentes);
    }
        
    
}
