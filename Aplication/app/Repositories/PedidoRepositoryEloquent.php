<?php

namespace WebDelivery\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use WebDelivery\Models\Pedido;
use WebDelivery\Presenters\PedidoPresenter;

/**
 * Class PedidoRepositoryEloquent
 * @package namespace WebDelivery\Repositories;
 */
class PedidoRepositoryEloquent extends BaseRepository implements PedidoRepository
{
    protected $skipPresenter = true;


    public function getByIdAndEntregador($id, $idEntregador)
    {
        $result = $this->model
            ->where('id', $id)
            ->where('usuario_entregador_id', $idEntregador)
            ->first();

        if ($result){
            return $this->parserResult($result);
        }
        throw (new ModelNotFoundException())->setModel($this->model());
    }

    public function getByIdAndCliente($id, $idCliente)
    {

        $result = $this->model
            ->where('id', $id)
            ->where('cliente_id', $idCliente)
            ->first();

        if ($result){
            return $this->parserResult($result);
        }
        throw (new ModelNotFoundException())->setModel($this->model());
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Pedido::class;
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
        return PedidoPresenter::class;
    }
}
