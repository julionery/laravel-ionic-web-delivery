<?php

namespace WebDelivery\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use WebDelivery\Repositories\ClienteRepository;
use WebDelivery\Models\Cliente;
use WebDelivery\Validators\ClienteValidator;

/**
 * Class ClienteRepositoryEloquent
 * @package namespace WebDelivery\Repositories;
 */
class ClienteRepositoryEloquent extends BaseRepository implements ClienteRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Cliente::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
