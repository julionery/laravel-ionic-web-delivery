<?php

namespace WebDelivery\Http\Controllers\Api\Cliente;

use Dmitrovskiy\IonicPush\PushProcessor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;
use WebDelivery\Http\Controllers\Controller;
use WebDelivery\Http\Requests;
use WebDelivery\Repositories\ClienteRepository;
use WebDelivery\Repositories\EmpresaRepository;
use WebDelivery\Repositories\PedidoRepository;
use WebDelivery\Repositories\UserRepository;
use WebDelivery\Services\PedidoService;

class ClienteCheckoutController extends Controller
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
    /**
     * @var EmpresaRepository
     */
    private $empresaRepository;
    /**
     * @var PushProcessor
     */
    private $pushProcessor;
    /**
     * @var ClienteRepository
     */
    private $clienteRepository;

    private $empresa;

    public function __construct(
        PedidoRepository $repository,
        UserRepository $userRepository,
        PedidoService $service,
        PushProcessor $pushProcessor,
        EmpresaRepository $empresaRepository,
        ClienteRepository $clienteRepository
    )
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
        $this->service = $service;
        $this->empresaRepository = $empresaRepository;
        $this->pushProcessor = $pushProcessor;
        $this->clienteRepository = $clienteRepository;
    }

    public function index()
    {
        $id = Authorizer::getResourceOwnerID();

        $clienteID = $this->userRepository->find($id)->cliente->id;
        $pedidos = $this->repository
            ->skipPresenter(false)
            ->scopeQuery(function ($query) use ($clienteID) {
                return $query->where('cliente_id', '=', $clienteID);
            })->paginate();

        return $pedidos;
    }

    public function store(Requests\CheckoutRequest $request)
    {
        $data = $request->all();
        
        $id = Authorizer::getResourceOwnerID();

        $clienteId = $this->userRepository->find($id)->cliente->id;
        $data['cliente_id'] = $clienteId;

        $pedido = $this->service->create($data);

        $cliente = $this->clienteRepository->find($clienteId)->user_id;

        $user = $this->userRepository->find($cliente);

        $empresa = $this->empresaRepository->find($pedido['empresa_id']);

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

        if(($this->empresa['emailPedidos'])!= ""){

            Mail::send('emails.novoPedido', compact('pedido'), function ($msj){
                $msj->subject('Novo Pedido Recebido!');
                $msj->to($this->empresa['emailPedidos']);
            });
        }
        
        $this->pushProcessor->notify([$user->device_token], [
            'title' => "{$empresa->nome_fantasia}",
            'message' => "Seu pedido #{$pedido->id} foi criado!"
        ]);

        return $this->repository
            ->skipPresenter(false)
            ->find($pedido->id);
    }

    public function show($id)
    {
        $idCliente = Authorizer::getResourceOwnerID();
        $clienteId = $this->userRepository->find($idCliente)->cliente->id;
        return $this->repository
            ->skipPresenter(false)
            ->getByIdAndCliente($id, $clienteId);
        
    }
}
