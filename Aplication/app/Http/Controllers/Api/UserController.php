<?php

namespace WebDelivery\Http\Controllers\Api;


use Illuminate\Http\Request;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;
use WebDelivery\Http\Controllers\Controller;
use WebDelivery\Repositories\UserRepository;

class UserController extends Controller
{

    /**
     * @var UserRepository
     */
    private $userRepository;
    
    public function __construct(
        UserRepository $userRepository
    )
    {
        $this->userRepository = $userRepository;
    }

    public function authenticated()
    {
        $id = Authorizer::getResourceOwnerId();
        return $this->userRepository->skipPresenter(false)->find($id);
    }
    
    public function updateDeviceToken(Request $request){
        $id = Authorizer::getResourceOwnerId();
        $deviceToken = $request->get('device_token');
        return $this->userRepository->updateDeviceToken($id, $deviceToken);
    }
}
