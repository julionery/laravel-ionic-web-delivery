<?php


namespace WebDelivery\Services;


use Illuminate\Support\Facades\Auth;
use WebDelivery\Repositories\ClienteRepository;
use WebDelivery\Repositories\UserRepository;

class ClienteService
{
    /**
     * @var ClienteRepository
     */
    private $clienteRepository;
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(ClienteRepository $clienteRepository, UserRepository $userRepository)
    {
        $this->clienteRepository = $clienteRepository;
        $this->userRepository = $userRepository;
    }

    public function update(array $data, $id)
    {
        $this->clienteRepository->update($data, $id);

        $usuarioID = $this->clienteRepository->find($id, ['user_id'])->user_id;
        
        $empresaId = $this->userRepository->find(Auth::user()->id)->empresa_id;
        $data['usuario']['empresa_id'] = $empresaId;

        $usuario =  $this->userRepository->update($data['usuario'], $usuarioID);

        if($data['senha'] == 'Sim') {
            $usuario['password'] = bcrypt(123456);
        }
        $usuario->save();
    }

    public function create(array $data)
    {
        $empresaId = $this->userRepository->find(Auth::user()->id)->empresa_id;
        $data['usuario']['empresa_id'] = $empresaId;
        $data['usuario']['password'] = bcrypt(123456);

        $usuario = $this->userRepository->create($data['usuario']);

        $data['user_id'] = $usuario->id;
        $this->clienteRepository->create($data);
    }

    public function createNewUser(array $data)
    {
        $data['usuario']['nome'] = $data['nome'];
        $data['usuario']['email'] = $data['email'];
        $data['usuario']['password'] = bcrypt($data['senha']);
        $data['usuario']['empresa_id'] = 1;

        $data['endereco'] = $data['endereco']." N°: ".$data['numero']." Quadra: ".$data['quadra']." Lote: ".$data['lote'];

        $usuario = $this->userRepository->create($data['usuario']);

        $data['user_id'] = $usuario->id;
        $this->clienteRepository->create($data);
    }
    
}