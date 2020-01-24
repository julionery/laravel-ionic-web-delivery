<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('pdf', 'PdfController@invoice');

Route::get('auth', function () {
    return view('auth.login');
});

Route::get('/admin', function () {
    return view('auth.login');
});

Route::get('/home', function () {
    return view('home');
});

Route::get('/layout', function () {
    return view('layout');
});

Route::get('/pizzada', function () {
    return view('site.pizzada');
});

Route::get('/comemoracoes', function () {
    return view('site.comemoracoes');
});

Route::get('/cardapios', function () {
    return view('site.comemoracoes');
});

Route::post('mail', ['as' => 'mail.store', 'uses' => 'MailController@store']);

Route::post('clientes/criarNovoUsuario', ['as' => 'clientes.criarNovoUsuario', 'uses' => 'ClientesController@criarNovoUsuario']);

Route::group(['prefix' => 'admin', 'middleware' => 'auth.checkrole:desenvolvedor', 'as' => 'admin.'], function () {

    Route::get('empresas', ['as' => 'empresas.index', 'uses' => 'EmpresasController@index']);
    Route::get('empresas/create', ['as' => 'empresas.create', 'uses' => 'EmpresasController@create']);
    Route::post('empresas/store', ['as' => 'empresas.store', 'uses' => 'EmpresasController@store']);
    Route::get('empresas/edit/{id}', ['as' => 'empresas.edit', 'uses' => 'EmpresasController@edit']);
    Route::post('empresas/update/{id}', ['as' => 'empresas.update', 'uses' => 'EmpresasController@update']);
    Route::get('empresas/destroy/{id}', ['as' => 'empresas.destroy', 'uses' => 'EmpresasController@destroy']);
    Route::get('empresas/relatorio/{id}', ['as' => 'empresas.pdf', 'uses' => 'EmpresasController@pdf']);

});

Route::group(['prefix' => 'admin', 'middleware' => 'auth.checkrole:admin', 'as' => 'admin.'], function () {

    Route::get('categorias', ['as' => 'categorias.index', 'uses' => 'CategoriasController@index']);
    Route::get('categorias/create', ['as' => 'categorias.create', 'uses' => 'CategoriasController@create']);
    Route::post('categorias/store', ['as' => 'categorias.store', 'uses' => 'CategoriasController@store']);
    Route::get('categorias/edit/{id}', ['as' => 'categorias.edit', 'uses' => 'CategoriasController@edit']);
    Route::post('categorias/update/{id}', ['as' => 'categorias.update', 'uses' => 'CategoriasController@update']);
    Route::get('categorias/destroy/{id}', ['as' => 'categorias.destroy', 'uses' => 'CategoriasController@destroy']);
    Route::get('categorias/relatorio/{id}', ['as' => 'categorias.pdf', 'uses' => 'CategoriasController@pdf']);

    Route::get('clientes', ['as' => 'clientes.index', 'uses' => 'ClientesController@index']);
    Route::get('clientes/create', ['as' => 'clientes.create', 'uses' => 'ClientesController@create']);
    Route::post('clientes/store', ['as' => 'clientes.store', 'uses' => 'ClientesController@store']);
    Route::get('clientes/edit/{id}', ['as' => 'clientes.edit', 'uses' => 'ClientesController@edit']);
    Route::post('clientes/update/{id}', ['as' => 'clientes.update', 'uses' => 'ClientesController@update']);
    Route::get('clientes/destroy/{id}', ['as' => 'clientes.destroy', 'uses' => 'ClientesController@destroy']);
    Route::get('clientes/relatorio/{id}', ['as' => 'clientes.pdf', 'uses' => 'ClientesController@pdf']);

    Route::get('entregadores', ['as' => 'entregadores.index', 'uses' => 'EntregadoresController@index']);
    Route::get('entregadores/create', ['as' => 'entregadores.create', 'uses' => 'EntregadoresController@create']);
    Route::post('entregadores/store', ['as' => 'entregadores.store', 'uses' => 'EntregadoresController@store']);
    Route::get('entregadores/edit/{id}', ['as' => 'entregadores.edit', 'uses' => 'EntregadoresController@edit']);
    Route::post('entregadores/update/{id}', ['as' => 'entregadores.update', 'uses' => 'EntregadoresController@update']);
    Route::get('entregadores/destroy/{id}', ['as' => 'entregadores.destroy', 'uses' => 'EntregadoresController@destroy']);
    Route::get('entregadores/relatorio/{id}', ['as' => 'entregadores.pdf', 'uses' => 'EntregadoresController@pdf']);

    Route::get('produtos', ['as' => 'produtos.index', 'uses' => 'ProdutosController@index']);
    Route::get('produtos/create', ['as' => 'produtos.create', 'uses' => 'ProdutosController@create']);
    Route::post('produtos/store', ['as' => 'produtos.store', 'uses' => 'ProdutosController@store']);
    Route::post('produtos/storeClone', ['as' => 'produtos.storeClone', 'uses' => 'ProdutosController@storeClone']);
    Route::get('produtos/edit/{id}', ['as' => 'produtos.edit', 'uses' => 'ProdutosController@edit']);
    Route::post('produtos/update/{id}', ['as' => 'produtos.update', 'uses' => 'ProdutosController@update']);
    Route::get('produtos/clonar/{id}', ['as' => 'produtos.clonar', 'uses' => 'ProdutosController@clonar']);
    Route::get('produtos/destroy/{id}', ['as' => 'produtos.destroy', 'uses' => 'ProdutosController@destroy']);
    Route::get('produtos/relatorio/{id}', ['as' => 'produtos.pdf', 'uses' => 'ProdutosController@pdf']);

    Route::get('componentes', ['as' => 'componentes.index', 'uses' => 'ComponentesController@index']);
    Route::get('componentes/create', ['as' => 'componentes.create', 'uses' => 'ComponentesController@create']);
    Route::post('componentes/store', ['as' => 'componentes.store', 'uses' => 'ComponentesController@store']);
    Route::get('componentes/edit/{id}', ['as' => 'componentes.edit', 'uses' => 'ComponentesController@edit']);
    Route::post('componentes/update/{id}', ['as' => 'componentes.update', 'uses' => 'ComponentesController@update']);
    Route::get('componentes/destroy/{id}', ['as' => 'componentes.destroy', 'uses' => 'ComponentesController@destroy']);
    Route::get('componentes/relatorio/{id}', ['as' => 'componentes.pdf', 'uses' => 'ComponentesController@pdf']);

    Route::get('ingredientes', ['as' => 'ingredientes.index', 'uses' => 'IngredientesController@index']);
    Route::get('ingredientes/create', ['as' => 'ingredientes.create', 'uses' => 'IngredientesController@create']);
    Route::post('ingredientes/store', ['as' => 'ingredientes.store', 'uses' => 'IngredientesController@store']);
    Route::get('ingredientes/edit/{id}', ['as' => 'ingredientes.edit', 'uses' => 'IngredientesController@edit']);
    Route::post('ingredientes/update/{id}', ['as' => 'ingredientes.update', 'uses' => 'IngredientesController@update']);
    Route::get('ingredientes/destroy/{id}', ['as' => 'ingredientes.destroy', 'uses' => 'IngredientesController@destroy']);
    Route::get('ingredientes/relatorio/{id}', ['as' => 'ingredientes.pdf', 'uses' => 'IngredientesController@pdf']);

    Route::get('pedidos', ['as' => 'pedidos.index', 'uses' => 'PedidosController@index']);
    Route::get('pedidos/create', ['as' => 'pedidos.create', 'uses' => 'PedidosController@create']);
    Route::get('pedidos/{id}', ['as' => 'pedidos.edit', 'uses' => 'PedidosController@edit']);
    Route::post('pedidos/update/{id}', ['as' => 'pedidos.update', 'uses' => 'PedidosController@update']);
    Route::get('pedidos/relatorio/{id}', ['as' => 'pedidos.pdf', 'uses' => 'PedidosController@pdf']);

    Route::get('cupoms', ['as' => 'cupoms.index', 'uses' => 'CupomsController@index']);
    Route::get('cupoms/create', ['as' => 'cupoms.create', 'uses' => 'CupomsController@create']);
    Route::post('cupoms/store', ['as' => 'cupoms.store', 'uses' => 'CupomsController@store']);
    Route::get('cupoms/edit/{id}', ['as' => 'cupoms.edit', 'uses' => 'CupomsController@edit']);
    Route::post('cupoms/update/{id}', ['as' => 'cupoms.update', 'uses' => 'CupomsController@update']);
    Route::get('cupoms/destroy/{id}', ['as' => 'cupoms.destroy', 'uses' => 'CupomsController@destroy']);
    Route::get('cupoms/relatorio/{id}', ['as' => 'cupoms.pdf', 'uses' => 'CupomsController@pdf']);

    Route::get('configuracoes', ['as' => 'configuracoes.index', 'uses' => 'EmpresasController@info']);
    Route::post('configuracoes/update/{id}', ['as' => 'configuracoes.update', 'uses' => 'EmpresasController@updateInfo']);

    Route::get('perfil', ['as' => 'perfil.index', 'uses' => 'ClientesController@info']);
    Route::post('perfil/update/{id}', ['as' => 'perfil.update', 'uses' => 'ClientesController@updateInfo']);

    Route::get('pedidos/create', ['as' => 'customer.pedido.new', 'uses' => 'PedidosController@newPedido']);
});

Route::group(['prefix' => 'customer', 'as' => 'customer.'], function () {

    Route::get('pedido', ['as' => 'pedido.index', 'uses' => 'CheckoutController@index']);
    Route::get('pedido/create', ['as' => 'pedido.create', 'uses' => 'CheckoutController@create']);
    Route::post('pedido/store', ['as' => 'pedido.store', 'uses' => 'CheckoutController@store']);
    Route::get('pedido/{id}', ['as' => 'pedido.edit', 'uses' => 'CheckoutController@edit']);
    Route::get('pedido/relatorio/{id}', ['as' => 'pedido.pdf', 'uses' => 'CheckoutController@pdf']);

    Route::get('perfil', ['as' => 'perfil.index', 'uses' => 'CheckoutController@info']);
    Route::post('perfil/update/{id}', ['as' => 'perfil.update', 'uses' => 'CheckoutController@updateInfo']);

});

Route::group(['middleware' => 'cors'], function () {

    Route::post('oauth/access_token', function () {
        return Response::json(Authorizer::issueAccessToken());
    });

    Route::group(['prefix' => 'api', 'middleware' => 'oauth', 'as' => 'api.'], function () {

        Route::group(['prefix' => 'cliente', 'middleware' => 'oauth.checkrole:cliente', 'as' => 'cliente.'], function () {
            Route::resource('pedido', 'Api\Cliente\ClienteCheckoutController', ['except' => ['create', 'edit', 'destroy']]);
            Route::get('produtos/{categoria_id}', 'Api\Cliente\ClienteProdutosController@index');
            Route::get('empresas', 'Api\Cliente\ClienteEmpresasController@index');
            Route::get('categorias/{empresa_id}', 'Api\Cliente\ClienteCategoriasController@index');
            Route::get('adicionais/{empresa_id}', 'Api\Cliente\ClienteAdicionaisController@index');
        });

        Route::group(['prefix' => 'entregador', 'middleware' => 'oauth.checkrole:entregador', 'as' => 'entregador.'], function () {
            Route::resource('pedido', 'Api\Entregador\EntregadorCheckoutController', ['except' => ['create', 'edit', 'store', 'destroy']]);
            Route::patch('pedido/{id}/update-status', ['uses' => 'Api\Entregador\EntregadorCheckoutController@updateStatus', 'as' => 'pedidos.update_status']);
            Route::post('pedido/{id}/geo', ['as' => 'pedido.geo', 'uses' => 'Api\Entregador\EntregadorCheckoutController@geo']);
        });

        Route::get('authenticated', 'Api\UserController@authenticated');
        Route::patch('device_token', 'Api\UserController@updateDeviceToken');
        Route::get('cupom/{codigo}', 'Api\CupomController@show');
    });
});
