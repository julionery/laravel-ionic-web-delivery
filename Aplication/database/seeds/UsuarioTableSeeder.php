<?php

use Illuminate\Database\Seeder;
use WebDelivery\Models\Cliente;
use WebDelivery\Models\User;

class UsuarioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'empresa_id' => 1,
            'nome' => 'User',
            'email'=> 'user@user.com',
            'password' => bcrypt(123456),
            'remember_token' => str_random(10),
        ])->cliente()->save(factory(Cliente::class)->make());

        factory(User::class)->create([
            'empresa_id' => 1,
            'nome' => 'Entregador',
            'email'=> 'entregador@entregador.com',
            'password' => bcrypt(123456),
            'tipo' => 'entregador',
            'remember_token' => str_random(10),
        ])->cliente()->save(factory(Cliente::class)->make());

        factory(User::class)->create([
            'empresa_id' => 1,
            'nome' => 'Admin',
            'email'=> 'admin@admin.com',
            'password' => bcrypt(123456),
            'tipo' => 'admin',
            'remember_token' => str_random(10),
        ])->cliente()->save(factory(Cliente::class)->make());

        factory(User::class, 10)->create()->each(function ($u){
            $u->cliente()->save(factory(Cliente::class)->make());
        });

        factory(User::class, 3)->create([
            'empresa_id' => 1,
            'password' => bcrypt(123456),
            'tipo' => 'entregador',
        ]);

    }
}
