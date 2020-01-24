<?php

namespace WebDelivery\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
     /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'WebDelivery\Repositories\CategoriaRepository',
            'WebDelivery\Repositories\CategoriaRepositoryEloquent'
        );

        $this->app->bind(
            'WebDelivery\Repositories\ClienteRepository',
            'WebDelivery\Repositories\ClienteRepositoryEloquent'
        );
        
        $this->app->bind(
            'WebDelivery\Repositories\ComponenteRepository',
            'WebDelivery\Repositories\ComponenteRepositoryEloquent'
        );

        $this->app->bind(
            'WebDelivery\Repositories\EmpresaRepository',
            'WebDelivery\Repositories\EmpresaRepositoryEloquent'
        );

        $this->app->bind(
            'WebDelivery\Repositories\PedidoRepository',
            'WebDelivery\Repositories\PedidoRepositoryEloquent'
        );

        $this->app->bind(
            'WebDelivery\Repositories\PedidoItemRepository',
            'WebDelivery\Repositories\PedidoItemRepositoryEloquent'
        );

        $this->app->bind(
            'WebDelivery\Repositories\ProdutoRepository',
            'WebDelivery\Repositories\ProdutoRepositoryEloquent'
        );
        
        $this->app->bind(
            'WebDelivery\Repositories\ProdutoItemRepository',
            'WebDelivery\Repositories\ProdutoItemRepositoryEloquent'
        );

        $this->app->bind(
            'WebDelivery\Repositories\ProdutoItemPedidoRepository',
            'WebDelivery\Repositories\ProdutoItemPedidoRepositoryEloquent'
        );

        $this->app->bind(
            'WebDelivery\Repositories\TamanhoRepository',
            'WebDelivery\Repositories\TamanhoRepositoryEloquent'
        );

        $this->app->bind(
            'WebDelivery\Repositories\UserRepository',
            'WebDelivery\Repositories\UserRepositoryEloquent'
        );

        $this->app->bind(
            'WebDelivery\Repositories\CupomRepository',
            'WebDelivery\Repositories\CupomRepositoryEloquent'
        );

    }
}
