<?php

namespace WebDelivery\Http\Middleware;

use Closure;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;
use WebDelivery\Repositories\UserRepository;

class OAuthCheckRole
{
    private $userRepository;
    
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $tipo)
    {
        $id = Authorizer::getResourceOwnerID();
        
        $usuario = $this->userRepository->find($id);
        
        if($usuario->tipo != $tipo){
            abort(403, 'Access Forbidden');
        }
        
        return $next($request);
    }
}
