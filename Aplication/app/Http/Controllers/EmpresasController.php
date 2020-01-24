<?php

namespace WebDelivery\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\This;
use WebDelivery\Http\Requests;
use WebDelivery\Http\Controllers\Controller;
use WebDelivery\Http\Requests\AdminEmpresaRequest;
use WebDelivery\Repositories\CategoriaRepository;
use WebDelivery\Repositories\EmpresaRepository;
use WebDelivery\Repositories\UserRepository;

class EmpresasController extends Controller
{

    /**
     * @var EmpresaRepository
     */
    private $repository;
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(EmpresaRepository $repository, UserRepository $userRepository)
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $empresas = $this->repository->all();
        return view('admin.empresas.index', compact('empresas'));
    }

    public function create()
    {
        return view('admin.empresas.create');
    }
    
    public function store(AdminEmpresaRequest $request)
    {
        $data = $request->all();
        $this->repository->create($data);
        return redirect()->route('admin.empresas.index')->with('message', 'Cadastrado com sucesso!');
    }
    
    public function edit($id)
    {
        $empresa = $this->repository->find($id);

        if($empresa['status']==1){
            $empresa['status']=null;
        }else{
            $empresa['status']='off';
        }
        return view('admin.empresas.edit', compact('empresa'));
    }

    public function info()
    {
        $empresaId = $this->userRepository->find(Auth::user()->id)->empresa_id;
        $empresa = $this->repository->find($empresaId);

        if($empresa['status']==1){
            $empresa['status']=null;
        }else{
            $empresa['status']='off';
        }

        return view('admin.empresas.info', compact('empresa'));
    }
    
    public function update(AdminEmpresaRequest $request, $id)
    {
        $data = $request->all();
        
        if(isset($data['status'])){
            $data['status']=1;
        }else{
            $data['status']=0;
        }
        $this->repository->update($data, $id);
        return redirect()->route('admin.empresas.index')->with('message', 'Atualizado com sucesso!');
    }

    public function updateInfo(AdminEmpresaRequest $request, $id)
    {
        $data = $request->all();

        if(isset($data['status'])){
            $data['status']=1;
        }else{
            $data['status']=0;
        }

        $this->repository->update($data, $id);
        return redirect('/home')->with('message', 'Atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $this->repository->delete($id);
        return redirect()->route('admin.empresas.index')->with('message', 'Deletado com sucesso!');
    }

    public function pdf($tipo)
    {
        $empresaId = $this->userRepository->find(Auth::user()->id)->empresa_id;

        $empresa = $this->repository->find($empresaId);

        $empresas = $this->repository->all();

        $dados['totalEmpresas'] = $empresas->count();

        $empresasPage = $empresas->chunk(7);

        $dataAtual = date('d/m/Y H:i');

        $data = \View::make('admin.empresas.pdf', compact('empresasPage', 'empresa', 'dados', 'dataAtual'));

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($data)->setPaper('a4', 'landscape')->setWarnings(false)->save('myfile.pdf');
        if ($tipo == 1) {
            return $pdf->stream();
        }
        if ($tipo == 2) {
            return $pdf->download('empresas.pdf');
        }
    }

}
