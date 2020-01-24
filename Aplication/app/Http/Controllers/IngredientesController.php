<?php

namespace WebDelivery\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use WebDelivery\Http\Requests;
use WebDelivery\Http\Controllers\Controller;
use WebDelivery\Http\Requests\AdminIngredienteRequest;
use WebDelivery\Repositories\ComponenteRepository;
use WebDelivery\Repositories\EmpresaRepository;
use WebDelivery\Repositories\UserRepository;

class IngredientesController extends Controller
{

    /**
     * @var ComponenteRepository
     */
    private $repository;
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var EmpresaRepository
     */
    private $empresaRepository;

    public function __construct(ComponenteRepository $repository, UserRepository $userRepository, EmpresaRepository $empresaRepository)
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
        $this->empresaRepository = $empresaRepository;
    }

    public function index()
    {
        $tipo = $this->userRepository->find(Auth::user()->id)->tipo;
        $empresaId = $this->userRepository->find(Auth::user()->id)->empresa_id;

        if($tipo=="desenvolvedor")
            $componentes = $this->repository->findByField('tipo', 'I');
        else
            $componentes = $this->repository->findByField(['tipo'=>'I', 'empresa_id' => $empresaId]);

        return view('admin.ingredientes.index', compact('componentes'));
    }

    public function create()
    {
        return view('admin.ingredientes.create');
    }

    public function store(AdminIngredienteRequest $request)
    {
        $data = $request->all();

        $empresaId = $this->userRepository->find(Auth::user()->id)->empresa_id;
        $data['empresa_id'] = $empresaId;
        $data['tipo'] = 'I';
        
        $this->repository->create($data);
        return redirect()->route('admin.ingredientes.index')->with('message', 'Cadastrado com sucesso!');
    }

    public function edit($id)
    {
        $componente = $this->repository->find($id);
        return view('admin.ingredientes.edit', compact('componente'));
    }

    public function update(AdminIngredienteRequest $request, $id)
    {
        $data = $request->all();

        $empresaId = $this->userRepository->find(Auth::user()->id)->empresa_id;
        $data['empresa_id'] = $empresaId;

        $this->repository->update($data, $id);
        return redirect()->route('admin.ingredientes.index')->with('message', 'Atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $this->repository->delete($id);
        return redirect()->route('admin.ingredientes.index')->with('message', 'Deletado com sucesso!');
    }

    public function pdf($tipo)
    {
        $userTipo = $this->userRepository->find(Auth::user()->id)->tipo;
        $empresaId = $this->userRepository->find(Auth::user()->id)->empresa_id;

        $empresa = $this->empresaRepository->find($empresaId);

        if ($userTipo == "desenvolvedor")
            $componentes = $this->repository->findByField('tipo', 'I');
        else
            $componentes = $this->repository->findByField(['tipo'=>'I', 'empresa_id' => $empresaId]);

        $dados['totalIngredientes'] = $componentes->count();

        $ingredientesPage = $componentes->chunk(20);

        $dataAtual = date('d/m/Y H:i');

        $data = \View::make('admin.ingredientes.pdf', compact('ingredientesPage', 'empresa', 'dados', 'dataAtual'));

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($data)->setPaper('a4', 'portrait')->setWarnings(false)->save('myfile.pdf');
        if ($tipo == 1) {
            return $pdf->stream();
        }
        if ($tipo == 2) {
            return $pdf->download('ingredientes.pdf');
        }
    }
}
