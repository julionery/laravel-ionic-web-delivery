<?php

namespace WebDelivery\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface CupomRepository
 * @package namespace WebDelivery\Repositories;
 */
interface CupomRepository extends RepositoryInterface
{
    public function findByCode($codigo);
}
