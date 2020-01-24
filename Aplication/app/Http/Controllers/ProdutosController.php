<?php

namespace WebDelivery\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use WebDelivery\Http\Requests;
use WebDelivery\Http\Requests\AdminProdutoRequest;
use WebDelivery\Models\Componente;
use WebDelivery\Models\Produto;
use WebDelivery\Repositories\CategoriaRepository;
use WebDelivery\Repositories\ComponenteRepository;
use WebDelivery\Repositories\EmpresaRepository;
use WebDelivery\Repositories\ProdutoRepository;
use WebDelivery\Repositories\UserRepository;

class ProdutosController extends Controller
{
    private $repository;
    /**
     * @var CategoriaRepository
     */
    private $categoriaRepository;
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var ComponenteRepository
     */
    private $componenteRepository;
    /**
     * @var EmpresaRepository
     */
    private $empresaRepository;

    public function __construct(ProdutoRepository $repository, UserRepository $userRepository, CategoriaRepository $categoriaRepository, ComponenteRepository $componenteRepository, EmpresaRepository $empresaRepository)
    {
        $this->repository = $repository;
        $this->categoriaRepository = $categoriaRepository;
        $this->userRepository = $userRepository;
        $this->componenteRepository = $componenteRepository;
        $this->empresaRepository = $empresaRepository;
    }

    public function index()
    {
        $tipo = $this->userRepository->find(Auth::user()->id)->tipo;
        $empresaId = $this->userRepository->find(Auth::user()->id)->empresa_id;

        if ($tipo == "desenvolvedor")
            $produtos = $this->repository->all();
        else
            $produtos = $this->repository->findByField('empresa_id', $empresaId);

        return view('admin.produtos.index', compact('produtos'));
    }

    public function create()
    {
        $tipo = $this->userRepository->find(Auth::user()->id)->tipo;
        $empresaId = $this->userRepository->find(Auth::user()->id)->empresa_id;

        if ($tipo == "desenvolvedor")
            $categorias = $this->categoriaRepository->all()->lists('nome', 'id');
        else
            $categorias = $this->categoriaRepository->findByField('empresa_id', $empresaId)->lists('nome', 'id');

        if ($tipo == "desenvolvedor")
            $data = $this->componenteRepository->findByField('tipo', 'I')->lists('nome', 'id');
        else
            $data = $this->componenteRepository->findWhere([['empresa_id', '=', $empresaId], ['tipo', '=', 'I']])->lists('nome', 'id');
        return view('admin.produtos.create', compact('categorias', 'data'));
    }

    public function store(AdminProdutoRequest $request)
    {
        $data = $request->all();

        $empresaId = $this->userRepository->find(Auth::user()->id)->empresa_id;
        $data['empresa_id'] = $empresaId;

        if (isset($data['adicionais'])) {
            $data['adicionais'] = 1;
        }

        $produto = $this->repository->create($data);
        if($request->ingredientes!=null){
            $produto->componentes()->sync($this->getComponentesIDs($request->ingredientes, $empresaId));
        }
        return redirect()->route('admin.produtos.index')->with('message', 'Cadastrado com sucesso!');
    }

    public function edit($id)
    {
        $tipo = $this->userRepository->find(Auth::user()->id)->tipo;
        $empresaId = $this->userRepository->find(Auth::user()->id)->empresa_id;
        $produtos = $this->repository->find($id);

        if ($tipo == "desenvolvedor")
            $categorias = $this->categoriaRepository->all()->lists('nome', 'id');
        else
            $categorias = $this->categoriaRepository->findByField('empresa_id', $empresaId)->lists('nome', 'id');

        if ($produtos['adicionais'] == 1) {
            $produtos['adicionais'] = null;
        } else {
            $produtos['adicionais'] = 'off';
        }


        return view('admin.produtos.edit', compact('produtos', 'categorias', 'data'));
    }

    public function clonar($id)
    {
        $empresaId = $this->userRepository->find(Auth::user()->id)->empresa_id;
        $produtos = $this->repository->find($id);

        if ($produtos['adicionais'] == 1) {
            $produtos['adicionais'] = null;
        } else {
            $produtos['adicionais'] = 'off';
        }

        $tipo = $this->userRepository->find(Auth::user()->id)->tipo;
        if ($tipo == "desenvolvedor")
            $categorias = $this->categoriaRepository->all()->lists('nome', 'id');
        else
            $categorias = $this->categoriaRepository->findByField('empresa_id', $empresaId)->lists('nome', 'id');

        return view('admin.produtos.clonar', compact('produtos', 'categorias'));
    }

    public function storeClone(AdminProdutoRequest $request)
    {
        $data = $request->all();

        $empresaId = $this->userRepository->find(Auth::user()->id)->empresa_id;
        $data['empresa_id'] = $empresaId;

        if (isset($data['adicionais'])) {
            $data['adicionais'] = 1;
        }

        $produto = $this->repository->create($data);

        $produto->componentes()->sync($this->getComponentes($request->componentes, $empresaId));

        return redirect()->route('admin.produtos.index')->with('message', 'Cadastrado com sucesso!');
    }

    public function update(AdminProdutoRequest $request, $id)
    {
        $data = $request->all();

        if (isset($data['adicionais'])) {
            $data['adicionais'] = 1;
        }

        $empresaId = $this->userRepository->find(Auth::user()->id)->empresa_id;
        $data['empresa_id'] = $empresaId;

        $this->repository->update($data, $id);

        $produto = $this->repository->find($id);

        $produto->componentes()->sync($this->getComponentes($request->componentes, $empresaId));

        return redirect()->route('admin.produtos.index')->with('message', 'Atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $this->repository->delete($id);
        return redirect()->route('admin.produtos.index')->with('message', 'Deletado com sucesso!');
    }

    private function getComponentesIDs($componentes, $empresa)
    {
        foreach ($componentes as $componenteNome) {
            $ingrediente = Componente::find($componenteNome);
            if (isset($ingrediente)) {
                $componentesIDs[] = $componenteNome;
            } else {
                $componentesIDs[] = Componente::create(['nome' => $componenteNome, 'empresa_id' => $empresa, 'tipo' => 'I'])->id;
            }
        }

        return $componentesIDs;

    }
    private function getComponentes($componentes, $empresa)
    {
         $componentesList = array_filter(array_map('trim', explode(',', $componentes)));
         $componentesIDs = [];
         foreach ($componentesList as $componenteNome) {
             $componentesIDs[] = Componente::firstOrCreate(['nome' => $componenteNome, 'empresa_id' => $empresa, 'tipo' => 'I'])->id;
         }
        return $componentesIDs;
    }


    public function pdf($tipo)
    {
        $userTipo = $this->userRepository->find(Auth::user()->id)->tipo;
        $empresaId = $this->userRepository->find(Auth::user()->id)->empresa_id;

        $empresa = $this->empresaRepository->find($empresaId);

        if ($userTipo == "desenvolvedor")
            $produtos = $this->repository->all();
        else
            $produtos = $this->repository->findByField('empresa_id', $empresaId);

        $dados['totalProdutos'] = $produtos->count();
        $valorTotal = 0;
        foreach ($produtos as $produto) {
            $valorTotal += $produto->preco;
        }
        $dados['valorTotal'] = $valorTotal;

        $produtosPage = $produtos->chunk(10);

        $dataAtual = date('d/m/Y H:i');

        $data = \View::make('admin.produtos.pdf', compact('produtosPage', 'empresa', 'dados', 'dataAtual'));

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($data)->setPaper('a4', 'landscape')->setWarnings(false)->save('myfile.pdf');
        if ($tipo == 1) {
            return $pdf->stream();
        }
        if ($tipo == 2) {
            return $pdf->download('produtos.pdf');
        }
    }
}
