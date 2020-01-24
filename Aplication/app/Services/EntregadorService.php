<?php


namespace WebDelivery\Services;


use WebDelivery\Repositories\ClienteRepository;
use WebDelivery\Repositories\UserRepository;

class EntregadorService
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

        $usuario = $this->userRepository->update($data['usuario'], $usuarioID);
        if($data['tipo'] == 'admin'){
            $usuario['tipo'] = 'admin';
        }elseif ($data['tipo'] == 'entregador'){
            $usuario['tipo'] = 'entregador';
        }

        if($data['senha'] == 'Sim') {
            $usuario['password'] = bcrypt(123456);
        }
        $usuario->save();
    }

    public function create(array $data)
    {
        $data['usuario']['password'] = bcrypt(123456);
        $usuario = $this->userRepository->create($data['usuario']);

        if($data['tipo'] == 'admin'){
            $usuario['tipo'] = 'admin';
        }elseif ($data['tipo'] == 'entregador'){
            $usuario['tipo'] = 'entregador';
        }

        $usuario->save();

        $data['user_id'] = $usuario->id;
        $this->clienteRepository->create($data);
    }
}