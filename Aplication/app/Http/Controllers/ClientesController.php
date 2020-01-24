<?php

namespace WebDelivery\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use WebDelivery\Repositories\EmpresaRepository;
use WebDelivery\Repositories\UserRepository;
use WebDelivery\Services\ClienteService;
use WebDelivery\Http\Requests;
use WebDelivery\Http\Requests\AdminClienteRequest;
use WebDelivery\Http\Requests\AdminClienteUpdateRequest;
use WebDelivery\Http\Requests\ClienteRequest;
use WebDelivery\Repositories\ClienteRepository;

class ClientesController extends Controller
{

    /**
     * @var ClienteRepository
     */
    private $repository;
    /**
     * @var ClienteService
     */
    private $clienteService;
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var EmpresaRepository
     */
    private $empresaRepository;

    public function __construct(ClienteRepository $repository, ClienteService $clienteService, UserRepository $userRepository, EmpresaRepository $empresaRepository)
    {
        $this->repository = $repository;
        $this->clienteService = $clienteService;
        $this->userRepository = $userRepository;
        $this->empresaRepository = $empresaRepository;
    }

    public function index()
    {
        $tipo = $this->userRepository->find(Auth::user()->id)->tipo;
        $empresaId = $this->userRepository->find(Auth::user()->id)->empresa_id;

        if ($tipo == "desenvolvedor")
            $clientes = $this->userRepository->findWhere([['tipo', '=', 'cliente']]);
        else
            $clientes = $this->userRepository->findWhere([['empresa_id', '=', $empresaId], ['tipo', '=', 'cliente']]);

        return view('admin.clientes.index', compact('clientes'));
    }

    public function create()
    {
        return view('admin.clientes.create');
    }

    public function store(AdminClienteRequest $request)
    {
        $data = $request->all();
        $this->clienteService->create($data);
        return redirect()->route('admin.clientes.index')->with('message', 'Cadastrado com sucesso!');
    }

    public function edit($id)
    {
        $usuario = $this->repository->findByField('user_id', $id)->first();
        $cliente = $this->repository->find($usuario->id);

        return view('admin.clientes.edit', compact('cliente'));
    }

    public function update(AdminClienteUpdateRequest $request, $id)
    {
        $data = $request->all();
        $this->clienteService->update($data, $id);
        return redirect()->route('admin.clientes.index')->with('message', 'Atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $clienteID = $this->repository->findByField('user_id', $id)->first();
        if (isset($clienteID)) {
            $this->repository->delete($clienteID->id);
        }
        $this->userRepository->delete($id);
        return redirect()->route('admin.clientes.index')->with('message', 'Deletado com sucesso!');
    }

    public function criarNovoUsuario(ClienteRequest $request)
    {
        $data = $request->all();
        $this->clienteService->createNewUser($data);
        return redirect('/auth/login')->with('message', 'Cadastrado com sucesso!');
    }

    public function info()
    {
        $user = $this->userRepository->find(Auth::user()->id);

        $usuario = $this->repository->findByField('user_id', $user->id)->first();
        $cliente = $this->repository->find($usuario->id);

        return view('admin.clientes.info', compact('cliente'));
    }

    public function updateInfo(AdminClienteUpdateRequest $request, $id)
    {
        $data = $request->all();

        if ($data['senha'] != '') {
            $data['usuario']['password'] = bcrypt($data['senha']);
        }

        $this->repository->update($data, $id);

        $usuarioID = $this->userRepository->find(Auth::user()->id)->id;

        $this->userRepository->update($data['usuario'], $usuarioID);

        return redirect('/home')->with('message', 'Atualizado com sucesso!');
    }

    public function pdf($tipo)
    {
        $userTipo = $this->userRepository->find(Auth::user()->id)->tipo;
        $empresaId = $this->userRepository->find(Auth::user()->id)->empresa_id;

        $empresa = $this->empresaRepository->find($empresaId);

        if ($userTipo == "desenvolvedor")
            $clientes = $this->userRepository->findWhere([['tipo', '=', 'cliente']]);
        else
            $clientes = $this->userRepository->findWhere([['empresa_id', '=', $empresaId], ['tipo', '=', 'cliente']]);

        $dados['totalClientes'] = $clientes->count();

        $clientesPage = $clientes->chunk(20);

        $dataAtual = date('d/m/Y H:i');

        $data = \View::make('admin.clientes.pdf', compact('clientesPage', 'empresa', 'dados', 'dataAtual'));

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($data)->setPaper('a4', 'portrait')->setWarnings(false)->save('myfile.pdf');
        if ($tipo == 1) {
            return $pdf->stream();
        }
        if ($tipo == 2) {
            return $pdf->download('clientes.pdf');
        }
    }
}
