<?php

namespace WebDelivery\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use WebDelivery\Http\Requests;
use WebDelivery\Http\Controllers\Controller;
use WebDelivery\Http\Requests\AdminCupomRequest;
use WebDelivery\Repositories\CupomRepository;
use WebDelivery\Repositories\EmpresaRepository;
use WebDelivery\Repositories\UserRepository;

class CupomsController extends Controller
{

    /**
     * @var CupomRepository
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

    public function __construct(CupomRepository $repository, UserRepository $userRepository, EmpresaRepository $empresaRepository)
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
            $cupoms = $this->repository->all();
        else
            $cupoms = $this->repository->findByField('empresa_id', $empresaId);

        return view('admin.cupoms.index', compact('cupoms'));
    }

    public function create()
    {
        return view('admin.cupoms.create');
    }

    public function store(AdminCupomRequest $request)
    {
        $data = $request->all();

        $empresaId = $this->userRepository->find(Auth::user()->id)->empresa_id;
        $data['empresa_id'] = $empresaId;

        $this->repository->create($data);
        return redirect()->route('admin.cupoms.index')->with('message', 'Cadastrado com sucesso!');
    }

    public function edit($id)
    {
        $cupom = $this->repository->find($id);
        return view('admin.cupoms.edit', compact('cupom'));
    }

    public function update(AdminCupomRequest $request, $id)
    {
        $data = $request->all();

        $empresaId = $this->userRepository->find(Auth::user()->id)->empresa_id;
        $data['empresa_id'] = $empresaId;

        $this->repository->update($data, $id);
        return redirect()->route('admin.cupoms.index')->with('message', 'Atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $this->repository->delete($id);
        return redirect()->route('admin.cupoms.index')->with('message', 'Deletado com sucesso!');
    }

    public function pdf($tipo)
    {
        $userTipo = $this->userRepository->find(Auth::user()->id)->tipo;
        $empresaId = $this->userRepository->find(Auth::user()->id)->empresa_id;

        $empresa = $this->empresaRepository->find($empresaId);

        if ($userTipo == "desenvolvedor")
            $cupoms = $this->repository->all();
        else
            $cupoms = $this->repository->findByField('empresa_id', $empresaId);

        $dados['totalCupons'] = $cupoms->count();
        $valorTotal = 0;
        foreach ($cupoms as $cupom) {
            $valorTotal += $cupom->valor;
        }
        $dados['valorTotal'] = $valorTotal;

        $cuponsPage = $cupoms->chunk(20);

        $dataAtual = date('d/m/Y H:i');

        $data = \View::make('admin.cupoms.pdf', compact('cuponsPage', 'empresa', 'dados', 'dataAtual'));

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($data)->setPaper('a4', 'portrait')->setWarnings(false)->save('myfile.pdf');
        if ($tipo == 1) {
            return $pdf->stream();
        }
        if ($tipo == 2) {
            return $pdf->download('cupons.pdf');
        }
    }

}
