<?php

namespace WebDelivery\Http\Controllers\Api\Cliente;


use WebDelivery\Http\Controllers\Controller;
use WebDelivery\Repositories\ProdutoRepository;

class ClienteProdutosController extends Controller
{

    /**
     * @var ProdutoRepository
     */
    private $repository;
    
    public function __construct(
        ProdutoRepository $repository
    )
    {
        $this->repository = $repository;
    }

    public function index($categoria_id)
    {
        return $produtos = $this->repository->skipPresenter(false)->findByField('categoria_id', $categoria_id);
    }

}
