<?php

namespace WebDelivery\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use WebDelivery\Http\Requests;
use Illuminate\Support\Facades\Auth;
use WebDelivery\Http\Requests\AdminClienteRequest;
use WebDelivery\Http\Requests\AdminClienteUpdateRequest;
use WebDelivery\Repositories\CategoriaRepository;
use WebDelivery\Repositories\ClienteRepository;
use WebDelivery\Repositories\EmpresaRepository;
use WebDelivery\Repositories\PedidoRepository;
use WebDelivery\Repositories\ProdutoRepository;
use WebDelivery\Repositories\UserRepository;
use WebDelivery\Services\PedidoService;

class CheckoutController extends Controller
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
     * @var ProdutoRepository
     */
    private $produtoRepository;
    /**
     * @var PedidoService
     */
    private $service;
    /**
     * @var ClienteRepository
     */
    private $clienteRepository;
    /**
     * @var EmpresaRepository
     */
    private $empresaRepository;

    private $empresa;

    public function __construct(
        PedidoRepository $repository,
        UserRepository $userRepository,
        ProdutoRepository $produtoRepository,
        EmpresaRepository $empresaRepository,
        PedidoService $service,
        ClienteRepository $clienteRepository
    )
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
        $this->produtoRepository = $produtoRepository;
        $this->service = $service;
        $this->clienteRepository = $clienteRepository;
        $this->empresaRepository = $empresaRepository;
    }
    
    public function index()
    {
        $clienteID = $this->userRepository->find(Auth::user()->id)->cliente->id;
        $pedidos = $this->repository->scopeQuery(function ($query) use($clienteID){
           return $query->where('cliente_id', '=', $clienteID); 
        })->all();


        return view('customer.pedido.index', compact('pedidos'));
    }

    public function create()
    {
        $produtos =$this->produtoRepository->listar();
        return view('customer.pedido.create', compact('produtos'));
    }

    public function edit($id, UserRepository $userRepository)
    {
        $pedido = $this->repository->find($id);
        return view('customer.pedido.edit', compact('pedido'));
    }

    public function store(Requests\CheckoutRequest $request)
    {
        $data = $request->all();

        $clienteId = $this->userRepository->find(Auth::user()->id)->cliente->id;
        $data['cliente_id'] = $clienteId;
        $data['empresa_id'] = 2;

        $pedido = $this->service->create($data);

        if (!isset($pedido['retirada']) || $pedido['retirada'] == "0") {
            $pedido['retirada'] = 'Delivery';
        } elseif ($pedido['retirada'] == "1") {
            $pedido['retirada'] = 'Balcão';
        }

        if (!isset($pedido['pagamento']) || $pedido['pagamento'] == "0") {
            $pedido['pagamento'] = 'Dinheiro';
        }elseif ($pedido['pagamento'] == "1") {
            $pedido['pagamento'] = 'Cartão';
        }elseif ($pedido['pagamento'] == "2") {
            $pedido['pagamento'] = 'Cheque';
        }

        Mail::send('emails.novoPedido', compact('pedido'), function ($msj){
            $msj->subject('Novo Pedido Recebido!');
            $msj->to('julio_cesar.an@hotmail.com');
        });
        
        $this->empresa = $this->empresaRepository->find($pedido['empresa_id']);

        if(isset($this->empresa['emailPedidos'])){

            Mail::send('emails.novoPedido', compact('pedido'), function ($msj){
                $msj->subject('Novo Pedido Recebido!');
                $msj->to($this->empresa['emailPedidos']);
            });
        }

        return redirect()->route('customer.pedido.index')->with('message', 'Cadastrado com sucesso!');
    }

    public function info()
    {
        $user = $this->userRepository->find(Auth::user()->id);
        $usuario = $this->clienteRepository->findByField('user_id', $user->id)->first();
        $cliente = $this->clienteRepository->find($usuario->id);

        return view('customer.info', compact('cliente'));
    }

    public function updateInfo(AdminClienteUpdateRequest $request, $id)
    {
        $data = $request->all();

        if ($data['senha']!=''){
            $data['usuario']['password'] = bcrypt($data['senha']);
        }

        $this->clienteRepository->update($data, $id);

        $usuarioID = $this->userRepository->find(Auth::user()->id)->id;

        $this->userRepository->update($data['usuario'], $usuarioID);

        return redirect('/home')->with('message', 'Atualizado com sucesso!');
    }

    public function pdf($tipo)
    {
        $clienteID = $this->userRepository->find(Auth::user()->id)->cliente->id;
       
        $pedidos = $this->repository->scopeQuery(function ($query) use($clienteID){
            return $query->where('cliente_id', '=', $clienteID);
        })->all();


        $dados['totalPedidos'] = $pedidos->count();
        $valorTotal = 0;
        foreach ($pedidos as $pedido) {
            $valorTotal += $pedido->total;
        }
        $dados['valorTotal'] = $valorTotal;

        $pedidosPage = $pedidos->chunk(20);

        $dataAtual = date('d/m/Y H:i');

        $data = \View::make('customer.pedido.pdf', compact('pedidosPage', 'dados', 'dataAtual'));

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($data)->setPaper('a4', 'portrait')->setWarnings(false)->save('myfile.pdf');
        if ($tipo == 1) {
            return $pdf->stream();
        }
        if ($tipo == 2) {
            return $pdf->download('pedidos.pdf');
        }
    }
}
