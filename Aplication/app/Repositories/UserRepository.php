<?php

namespace WebDelivery\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface UserRepository
 * @package namespace WebDelivery\Repositories;
 */
interface UserRepository extends RepositoryInterface
{
    public function updateDeviceToken($id, $deviceToken);
}
