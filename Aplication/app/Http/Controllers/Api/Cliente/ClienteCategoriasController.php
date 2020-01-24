<?php

namespace WebDelivery\Http\Controllers\Api\Cliente;


use WebDelivery\Http\Controllers\Controller;
use WebDelivery\Repositories\CategoriaRepository;

class ClienteCategoriasController extends Controller
{

    /**
     * @var CategoriaRepository
     */
    private $repository;
    
    public function __construct(
        CategoriaRepository $repository
    )
    {
        $this->repository = $repository;
    }

    public function index($empresa_id)
    {
        return $categorias = $this->repository->skipPresenter(false)->findByField('empresa_id', $empresa_id);
    }

}
