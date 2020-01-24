<?php

use Illuminate\Database\Seeder;
use WebDelivery\Models\Categoria;
use WebDelivery\Models\Empresa;
use WebDelivery\Models\Produto;
use WebDelivery\Models\User;

class EmpresaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Empresa::class, 3)->create();
            //for($i = 1 ; $i <= 5; $i++){
            //    $e->usuarios()->save(factory(User::class)->make());
            //}

        
    }
}
