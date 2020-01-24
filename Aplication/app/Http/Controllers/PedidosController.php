<?php

namespace WebDelivery\Http\Controllers;

use Dmitrovskiy\IonicPush\PushProcessor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use WebDelivery\Repositories\EmpresaRepository;
use WebDelivery\Repositories\PedidoRepository;
use WebDelivery\Repositories\UserRepository;

class PedidosController extends Controller
{

    /**
     * @var PedidoRepository
     */
    private $repository;
    /**
     * @var PushProcessor
     */
    private $pushProcessor;
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var EmpresaRepository
     */
    private $empresaRepository;

    public function __construct(PedidoRepository $repository, PushProcessor $pushProcessor, UserRepository $userRepository, EmpresaRepository $empresaRepository)
    {
        $this->repository = $repository;
        $this->pushProcessor = $pushProcessor;
        $this->userRepository = $userRepository;
        $this->empresaRepository = $empresaRepository;
    }

    public function index()
    {
        $tipo = $this->userRepository->find(Auth::user()->id)->tipo;
        $empresaId = $this->userRepository->find(Auth::user()->id)->empresa_id;

        if($tipo=="desenvolvedor")
            $pedidos = $this->repository->all();
        else
            $pedidos = $this->repository->findByField('empresa_id', $empresaId);

        return view('admin.pedidos.index', compact('pedidos'));
    }
    
    public function create()
    {
        return view('admin.pedidos.create');
    }
    
    public function edit($id, UserRepository $userRepository)
    {
        $list_status = [0=>'Pendente', 1=>'Recebido', 2=>'Em preparação', 3=>'A caminho', 4=>'Entregue', 5=>'Cancelado'];
        
        $empresaId = $this->userRepository->find(Auth::user()->id)->empresa_id;

        $entregador = $userRepository->getEntregadores($empresaId);

        $pedido = $this->repository->find($id);
        return view('admin.pedidos.edit', compact('pedido', 'list_status', 'entregador'));
    }
    
    public function update(Request $request, $id)
    {
        $all = $request->all();
        $status = $all['status'];
        $pedido = $this->repository->find($id);
        $this->repository->update($all, $id);
        $user = $pedido->cliente->usuario;
        $empresa = $this->empresaRepository->find($pedido['empresa_id']);
        $tempo = $all['tempo'];
        switch ((int)$status){
            case 1: //Recebido
                if($tempo!='0'){
                    $this->pushProcessor->notify([$user->device_token], [
                        'title' => "{$empresa->nome_fantasia}",
                        'message' => "Seu pedido #{$pedido->id} foi recebido! \nEstimativa de entrega {$tempo} minutos!"
                    ]);
                }else{
                    $this->pushProcessor->notify([$user->device_token], [
                        'title' => "{$empresa->nome_fantasia}",
                        'message' => "Seu pedido #{$pedido->id} foi recebido!"
                    ]);
                }
                break;
            case 2: //Em preparação
                if($tempo!='0'){
                    $this->pushProcessor->notify([$user->device_token], [
                        'title' => "{$empresa->nome_fantasia}",
                        'message' => "Seu pedido #{$pedido->id} está em preparação! \nEstimativa de entrega {$tempo} minutos!"
                    ]);
                }else {
                    $this->pushProcessor->notify([$user->device_token], [
                        'title' => "{$empresa->nome_fantasia}",
                        'message' => "Seu pedido #{$pedido->id} está em preparação!"
                    ]);
                }
                break;
            case 3: //A caminho
                if($tempo!='0'){
                    $this->pushProcessor->notify([$user->device_token], [
                        'title' => "{$empresa->nome_fantasia}",
                        'message' => "Seu pedido #{$pedido->id} está a caminho! \nEstimativa de entrega {$tempo} minutos!"
                    ]);
                }else {
                    $this->pushProcessor->notify([$user->device_token], [
                        'title' => "{$empresa->nome_fantasia}",
                        'message' => "Seu pedido #{$pedido->id} está a caminho!"
                    ]);
                }
                break;
            case 4: //Entregue
                $this->pushProcessor->notify([$user->device_token], [
                    'title' => "{$empresa->nome_fantasia}",
                    'message' => "Seu pedido #{$pedido->id} acabou de ser entregue!"
                ]);
                break;
            case 5: //Cancelado
                $this->pushProcessor->notify([$user->device_token], [
                    'title' => "{$empresa->nome_fantasia}",
                    'message' => "Seu pedido #{$pedido->id} foi cancelado!",
                ]);
                break;
        }
        return redirect()->route('admin.pedidos.index')->with('message', 'Atualizado com sucesso!');
    }

    public function pdf($tipo)
    {
        $userTipo = $this->userRepository->find(Auth::user()->id)->tipo;
        $empresaId = $this->userRepository->find(Auth::user()->id)->empresa_id;

        $empresa = $this->empresaRepository->find($empresaId);

        if ($userTipo == "desenvolvedor")
            $pedidos = $this->repository->all();
        else
            $pedidos = $this->repository->findByField('empresa_id', $empresaId);

        $dados['totalPedidos'] = $pedidos->count();
        $valorTotal = 0;
        foreach ($pedidos as $pedido) {
            $valorTotal += $pedido->total;
        }
        $dados['valorTotal'] = $valorTotal;

        $dataAtual = date('d/m/Y H:i');

        $pedidosPage = $pedidos->chunk(20);

        $data = \View::make('admin.pedidos.pdf', compact('pedidosPage', 'empresa', 'dados', 'dataAtual'));

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($data)->setPaper('A4', 'retrait')->setWarnings(false)->save('myfile.pdf');
        if ($tipo == 1) {
            return $pdf->stream();
        }
        if ($tipo == 2) {
            return $pdf->download('pedidos.pdf');
        }
    }
    
    public function newPedido()
    {
        return view('customer.pedido.new');
    }
}