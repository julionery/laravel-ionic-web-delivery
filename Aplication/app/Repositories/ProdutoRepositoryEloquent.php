<?php

namespace WebDelivery\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use WebDelivery\Presenters\ProdutoPresenter;
use WebDelivery\Repositories\ProdutoRepository;
use WebDelivery\Models\Produto;

/**
 * Class ProdutoRepositoryEloquent
 * @package namespace WebDelivery\Repositories;
 */
class ProdutoRepositoryEloquent extends BaseRepository implements ProdutoRepository
{
    protected $skipPresenter = true;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Produto::class;
    }

    public function listar()
    {
        return $this->model->get(['id', 'nome', 'preco']);
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function presenter()
    {
        return ProdutoPresenter::class;
    }

}
