<?php

namespace WebDelivery\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use WebDelivery\Presenters\EmpresaPresenter;
use WebDelivery\Repositories\EmpresaRepository;
use WebDelivery\Models\Empresa;

/**
 * Class EmpresaRepositoryEloquent
 * @package namespace WebDelivery\Repositories;
 */
class EmpresaRepositoryEloquent extends BaseRepository implements EmpresaRepository
{
    protected $skipPresenter = true;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Empresa::class;
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
        return EmpresaPresenter::class;
    }

}
