<?php

namespace WebDelivery\Http\Controllers\Api\Cliente;


use WebDelivery\Http\Controllers\Controller;
use WebDelivery\Repositories\EmpresaRepository;

class ClienteEmpresasController extends Controller
{

    /**
     * @var EmpresaRepository
     */
    private $repository;
    
    public function __construct(
        EmpresaRepository $repository
    )
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return $empresas = $this->repository->skipPresenter(false)->all();
    }

}
