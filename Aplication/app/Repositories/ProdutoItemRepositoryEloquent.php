<?php

namespace WebDelivery\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use WebDelivery\Repositories\ProdutoItemRepository;
use WebDelivery\Models\ProdutoItem;
use WebDelivery\Validators\ProdutoItemValidator;

/**
 * Class ProdutoItemRepositoryEloquent
 * @package namespace WebDelivery\Repositories;
 */
class ProdutoItemRepositoryEloquent extends BaseRepository implements ProdutoItemRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ProdutoItem::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
