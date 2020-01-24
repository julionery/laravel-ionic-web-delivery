<?php

namespace WebDelivery\Http\Controllers\Api\Entregador;

use Illuminate\Http\Request;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;
use WebDelivery\Events\GetLocationEntregador;
use WebDelivery\Http\Controllers\Controller;
use WebDelivery\Http\Requests;
use WebDelivery\Models\Geo;
use WebDelivery\Repositories\PedidoRepository;
use WebDelivery\Repositories\UserRepository;
use WebDelivery\Services\PedidoService;

class EntregadorCheckoutController extends Controller
{

    /**
     * @var PedidoRepository
     */
    private $repository;
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var PedidoService
     */
    private $service;


    public function __construct(
        PedidoRepository $repository,
        UserRepository $userRepository,
        PedidoService $service
    )
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
        $this->service = $service;
    }

    public function index()
    {
        $id = Authorizer::getResourceOwnerID();

        $pedidos = $this->repository
            ->skipPresenter(false)
            ->scopeQuery(function ($query) use ($id) {
            return $query->where('usuario_entregador_id', '=', $id);
        })->paginate();

        return $pedidos;
    }

    public function show($id)
    {
        $idEntregador = Authorizer::getResourceOwnerID();
        return $this->repository
            ->skipPresenter(false)
            ->getByIdAndEntregador($id, $idEntregador);
    }

    public function updateStatus (Request $request, $id)
    {
        $idEntregador = Authorizer::getResourceOwnerID();
        return $this->service->updateStatus($id, $idEntregador, $request->get('status'));
    }

    public function geo(Request $request, Geo $geo, $id){
        $idEntregador = Authorizer::getResourceOwnerID();
        $pedido = $this->repository->getByIdAndEntregador($id, $idEntregador);
        $geo->lat = $request->get('lat');
        $geo->long = $request->get('long');
        event(new GetLocationEntregador($geo, $pedido));
        return $geo;
    }

}
