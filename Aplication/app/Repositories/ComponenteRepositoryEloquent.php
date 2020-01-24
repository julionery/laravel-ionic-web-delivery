<?php

namespace WebDelivery\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use WebDelivery\Presenters\ComponentePresenter;
use WebDelivery\Repositories\ComponenteRepository;
use WebDelivery\Models\Componente;

/**
 * Class ComponenteRepositoryEloquent
 * @package namespace WebDelivery\Repositories;
 */
class ComponenteRepositoryEloquent extends BaseRepository implements ComponenteRepository
{
    protected $skipPresenter = true;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Componente::class;
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
        return ComponentePresenter::class;
    }

}

