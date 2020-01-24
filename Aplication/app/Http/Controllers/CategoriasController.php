<?php

namespace WebDelivery\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use WebDelivery\Http\Requests;
use WebDelivery\Http\Controllers\Controller;
use WebDelivery\Http\Requests\AdminCategoriaRequest;
use WebDelivery\Repositories\CategoriaRepository;
use WebDelivery\Repositories\EmpresaRepository;
use WebDelivery\Repositories\UserRepository;

class CategoriasController extends Controller
{

    /**
     * @var CategoriaRepository
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

    public function __construct(CategoriaRepository $repository, UserRepository $userRepository, EmpresaRepository $empresaRepository)
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
        $this->empresaRepository = $empresaRepository;
    }

    public function index()
    {
        $tipo = $this->userRepository->find(Auth::user()->id)->tipo;
        $empresaId = $this->userRepository->find(Auth::user()->id)->empresa_id;

        if ($tipo == "desenvolvedor")
            $categorias = $this->repository->all();
        else
            $categorias = $this->repository->findByField('empresa_id', $empresaId);

        return view('admin.categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('admin.categorias.create');
    }

    public function store(AdminCategoriaRequest $request)
    {
        $data = $request->all();

        $empresaId = $this->userRepository->find(Auth::user()->id)->empresa_id;
        $data['empresa_id'] = $empresaId;

        $this->repository->create($data);
        return redirect()->route('admin.categorias.index')->with('message', 'Cadastrado com sucesso!');
    }

    public function edit($id)
    {
        $categoria = $this->repository->find($id);
        return view('admin.categorias.edit', compact('categoria'));
    }

    public function update(AdminCategoriaRequest $request, $id)
    {
        $data = $request->all();

        $empresaId = $this->userRepository->find(Auth::user()->id)->empresa_id;
        $data['empresa_id'] = $empresaId;

        $this->repository->update($data, $id);
        return redirect()->route('admin.categorias.index')->with('message', 'Atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $this->repository->delete($id);
        return redirect()->route('admin.categorias.index')->with('message', 'Deletado com sucesso!');
    }

    public function pdf($tipo)
    {
        $userTipo = $this->userRepository->find(Auth::user()->id)->tipo;
        $empresaId = $this->userRepository->find(Auth::user()->id)->empresa_id;

        $empresa = $this->empresaRepository->find($empresaId);
        
        if ($userTipo == "desenvolvedor")
            $categorias = $this->repository->all();
        else
            $categorias = $this->repository->findByField('empresa_id', $empresaId);

        $cont = $categorias->count();
        $dataAtual = date('d/m/Y H:i');

        $categoriasPage = $categorias->chunk(20);
        
        $data = \View::make('admin.categorias.pdf', compact('categoriasPage', 'empresa', 'cont', 'dataAtual'));

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($data)->setPaper('a4', 'portrait')->setWarnings(false)->save('myfile.pdf');
        if ($tipo == 1) {
            return $pdf->stream();
        }
        if ($tipo == 2) {
            return $pdf->download('categorias.pdf');
        }
    }

}
