<?php

namespace WebDelivery\Transformers;

use Illuminate\Database\Eloquent\Collection;
use League\Fractal\TransformerAbstract;
use WebDelivery\Models\Pedido;

/**
 * Class PedidoTransformer
 * @package namespace WebDelivery\Transformers;
 */
class PedidoTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['cupom', 'items', 'cliente'];
    protected $defaultIncludes = ['empresa'];

    /**
     * Transform the \Pedido entity
     * @param \Pedido $model
     *
     * @return array
     */
    public function transform(Pedido $model)
    {
        return [
            'id'         => $model->id,
            'total'      => $model->total,
            'retirada'   => (int) $model->retirada,
            'pagamento'  => (int) $model->pagamento,
            'troco'      => $model->troco,
            'status'     => $model->status,
            'hash'       => $model->hash,
            'produto_nomes' => $this->getArrayProductNames($model->itens),
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }

    protected function getArrayProductNames(Collection $items){
        $nomes = [];
        foreach ($items as $item){
            $nomes[] = $item->produto->nome;
        }
        return $nomes;
    }
    
    public function includeCliente(Pedido $model)
    {
        return $this->item($model->cliente, new ClienteTransformer());
    }

    public function includeEmpresa(Pedido $model)
    {
        return $this->item($model->empresa, new EmpresaTransformer());
    }

    public function includeCupom(Pedido $model)
    {
        if (!$model->cupom)
        {
            return null;
        }

        return $this->item($model->cupom, new CupomTransformer());
    }

    public function includeItems(Pedido $model)
    {
        return $this->collection($model->itens, new PedidoItemTransformer());
    }

}
