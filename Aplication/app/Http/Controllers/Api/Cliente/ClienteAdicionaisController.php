<?php

namespace WebDelivery\Http\Controllers\Api\Cliente;


use WebDelivery\Http\Controllers\Controller;
use WebDelivery\Repositories\ComponenteRepository;
use Illuminate\Http\Request;

class ClienteAdicionaisController extends Controller
{

    /**
     * @var ComponenteRepository
     */
    private $repository;
    
    public function __construct(
        ComponenteRepository $repository
    )
    {
        $this->repository = $repository;
    }

    public function index($empresa_id)
    {
        return $adicionais = $this->repository->skipPresenter(false)->findWhere(['empresa_id' => $empresa_id, 'tipo'=>'A']);

    }

}
