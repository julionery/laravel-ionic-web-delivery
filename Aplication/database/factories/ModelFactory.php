<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(WebDelivery\Models\Empresa::class, function (Faker\Generator $faker){
    return[
        'razao_social' => $faker-> word,
        'nome_fantasia' => $faker-> word,
        'cnpj' => rand(10000000000,9999999999)
    ];
});

$factory->define(WebDelivery\Models\User::class, function (Faker\Generator $faker) {
    return [
        'empresa_id'=> rand(1,3),
        'nome' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(WebDelivery\Models\Categoria::class, function (Faker\Generator $faker){
    return[
        'empresa_id'=> rand(1,3),
        'nome' => $faker-> word
    ];
});

$factory->define(WebDelivery\Models\Cliente::class, function (Faker\Generator $faker){
    return[
        'telefone' => $faker-> phoneNumber,
        'endereco' => $faker-> address,
        'bairro' => $faker-> word,
        'cep' => $faker-> postcode,
        'cidade' => $faker-> city,
        'estado' => $faker-> state
    ];
});

$factory->define(WebDelivery\Models\Produto::class, function (Faker\Generator $faker){
    return[
        'empresa_id'=> rand(1,3),
        'categoria_id'=> rand(1,10),
        'nome' => $faker-> word,
        'descricao' => $faker->sentence,
        'preco' => rand(10,50)
    ];
});


$factory->define(WebDelivery\Models\Componente::class, function (Faker\Generator $faker){
    return[
        'empresa_id'=> rand(1,3),
        'nome' => $faker-> word,
        'descricao' => $faker->sentence,
        'preco' => rand(10,50)
    ];
});


$factory->define(WebDelivery\Models\Pedido::class, function (Faker\Generator $faker){
    return[
        'empresa_id'=> rand(1,3),
        'cliente_id'=> rand(1,10),
        'total' =>  rand(30,100),
        'status' => 0,
    ];
});

$factory->define(WebDelivery\Models\PedidoItem::class, function (Faker\Generator $faker){
    return[
    ];
});

$factory->define(WebDelivery\Models\Oauth_client::class, function (Faker\Generator $faker){
    return[
    ];
});

$factory->define(WebDelivery\Models\Cupom::class, function (Faker\Generator $faker){
    return[
        'empresa_id'=> rand(1,3),
        'codigo'=>rand(100, 10000),
        'valor'=> rand(50, 100)
    ];
});