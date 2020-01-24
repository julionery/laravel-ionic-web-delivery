<?php

namespace WebDelivery\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use WebDelivery\Repositories\ProdutoItemPedidoRepository;
use WebDelivery\Models\ProdutoItemPedido;
use WebDelivery\Validators\ProdutoItemPedidoValidator;

/**
 * Class ProdutoItemPedidoRepositoryEloquent
 * @package namespace WebDelivery\Repositories;
 */
class ProdutoItemPedidoRepositoryEloquent extends BaseRepository implements ProdutoItemPedidoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ProdutoItemPedido::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
