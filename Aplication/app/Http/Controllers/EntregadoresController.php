<?php

namespace WebDelivery\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use WebDelivery\Http\Requests\AdminEntregadorUpdateRequest;
use WebDelivery\Repositories\EmpresaRepository;
use WebDelivery\Repositories\UserRepository;
use WebDelivery\Services\EntregadorService;
use WebDelivery\Http\Requests;
use WebDelivery\Http\Requests\AdminEntregadorRequest;
use WebDelivery\Repositories\ClienteRepository;

class EntregadoresController extends Controller
{

    /**
     * @var ClienteRepository
     */
    private $repository;
    /**
     * @var EntregadorService
     */
    private $entregadorService;
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var EmpresaRepository
     */
    private $empresaRepository;

    public function __construct(ClienteRepository $repository, EntregadorService $entregadorService, UserRepository $userRepository, EmpresaRepository $empresaRepository)
    {
        $this->repository = $repository;
        $this->entregadorService = $entregadorService;
        $this->userRepository = $userRepository;
        $this->empresaRepository = $empresaRepository;
    }

    public function index()
    {
        $tipo = $this->userRepository->find(Auth::user()->id)->tipo;
        $empresaId = $this->userRepository->find(Auth::user()->id)->empresa_id;

        if($tipo=="desenvolvedor")
            $entregadores = $this->userRepository->findWhere([['tipo','!=', 'cliente']]);
        else
            $entregadores = $this->userRepository->findByField('empresa_id' , $empresaId);

        return view('admin.entregadores.index', compact('entregadores'));
    }

    public function create()
    {
        $empresas = $this->empresaRepository->lists('nome_fantasia', 'id');

        return view('admin.entregadores.create', compact('empresas'));
    }
    
    public function store(AdminEntregadorRequest $request)
    {
        $data = $request->all();

        $tipo = $this->userRepository->find(Auth::user()->id)->tipo;
        $empresaId = $this->userRepository->find(Auth::user()->id)->empresa_id;

        if($tipo=="desenvolvedor" && isset($data['empresa_id']))
            $data['usuario']['empresa_id'] = $data['empresa_id'];
        else
            $data['usuario']['empresa_id'] = $empresaId;

        $this->entregadorService->create($data);
        return redirect()->route('admin.entregadores.index')->with('message', 'Cadastrado com sucesso!');
    }
    
    public function edit($id)
    {
        $cliente = $this->repository->findByField('user_id', $id)->first();
        $user = $this->userRepository->find($id);
        $entregador = $this->repository->find($cliente->id);
        $entregador['tipo'] = $user->tipo;
        return view('admin.entregadores.edit', compact('entregador'));
    }
    
    public function update(AdminEntregadorUpdateRequest $request, $id)
    {
        $data = $request->all();
        $this->entregadorService->update($data, $id);
        return redirect()->route('admin.entregadores.index')->with('message', 'Atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $clienteID = $this->repository->findByField('user_id', $id)->first();

        if(isset($clienteID)){
            $this->repository->delete($clienteID->id);
        }
        $this->userRepository->delete($id);

        return redirect()->route('admin.entregadores.index')->with('message', 'Deletado com sucesso!');
    }

    public function pdf($tipo)
    {
        $userTipo = $this->userRepository->find(Auth::user()->id)->tipo;
        $empresaId = $this->userRepository->find(Auth::user()->id)->empresa_id;

        $empresa = $this->empresaRepository->find($empresaId);

        if($userTipo=="desenvolvedor")
            $funcionarios = $this->userRepository->findWhere([['tipo','!=', 'cliente']]);
        else
            $funcionarios = $this->userRepository->findWhere([['empresa_id' , '=', $empresaId], ['tipo','!=', 'cliente']]);

        $funcionariosPage = $funcionarios->chunk(20);

        $dataAtual = date('d/m/Y H:i');

        $data = \View::make('admin.entregadores.pdf', compact('funcionariosPage', 'empresa', 'dataAtual'));

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($data)->setPaper('a4', 'portrait')->setWarnings(false)->save('myfile.pdf');
        if ($tipo == 1) {
            return $pdf->stream();
        }
        if ($tipo == 2) {
            return $pdf->download('funcionarios.pdf');
        }
    }
}
