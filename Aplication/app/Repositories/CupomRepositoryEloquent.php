<?php

namespace WebDelivery\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use WebDelivery\Repositories\CupomRepository;
use WebDelivery\Models\Cupom;
use WebDelivery\Presenters\CupomPresenter;

/**
 * Class CupomRepositoryEloquent
 * @package namespace WebDelivery\Repositories;
 */
class CupomRepositoryEloquent extends BaseRepository implements CupomRepository
{
    protected $skipPresenter = true;
    
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Cupom::class;
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
        return CupomPresenter::class;
    }

    public function findByCode($codigo)
    {
        $result = $this->model
            ->where('codigo', $codigo)
            ->where('usado', 0)
            ->first();
        
        if($result){
            return $this->parserResult($result);
        }
        throw (new ModelNotFoundException())->setModel($this->model());
    }
}
