<?php

namespace WebDelivery\Http\Controllers;

use Illuminate\Http\Request;

use WebDelivery\Http\Requests;
use WebDelivery\Http\Controllers\Controller;
use WebDelivery\Repositories\CategoriaRepository;
use WebDelivery\Repositories\UserRepository;

class PdfController extends Controller
{
    /**
     * @var CategoriaRepository
     */
    private $categoriaRepository;
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(CategoriaRepository $categoriaRepository, UserRepository $userRepository)
    {
        $this->categoriaRepository = $categoriaRepository;
        $this->userRepository = $userRepository;
    }

    public function invoice()
    {
        $categorias = $this->userRepository->all();

        $data = \View::make('pdf.invoice', ['categorias' => $categorias]);

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($data);


        return $pdf->stream();
        //return $pdf->download('arquivo.pdf');
    }


}
