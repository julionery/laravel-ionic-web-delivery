<?php

namespace WebDelivery\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface PedidoRepository
 * @package namespace WebDelivery\Repositories;
 */
interface PedidoRepository extends RepositoryInterface
{
    public function getByIdAndEntregador($id, $idEntregador);
    
    public function getByIdAndCliente($id, $idCliente);
}
