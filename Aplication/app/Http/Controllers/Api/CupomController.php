<?php

namespace WebDelivery\Http\Controllers\Api;


use WebDelivery\Http\Controllers\Controller;
use WebDelivery\Repositories\CupomRepository;

class CupomController extends Controller
{

    /**
     * @var CupomRepository
     */
    private $repository;
    
    public function __construct(
        CupomRepository $repository
    )
    {
        $this->repository = $repository;
    }

    public function show($codigo)
    {
        return $cupoms = $this->repository->skipPresenter(false)->findByCode($codigo);
    }

}
