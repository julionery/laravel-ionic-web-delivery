<?php

namespace WebDelivery\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use WebDelivery\Repositories\PedidoItemRepository;
use WebDelivery\Models\PedidoItem;
use WebDelivery\Validators\PedidoItemValidator;

/**
 * Class PedidoItemRepositoryEloquent
 * @package namespace WebDelivery\Repositories;
 */
class PedidoItemRepositoryEloquent extends BaseRepository implements PedidoItemRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PedidoItem::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
