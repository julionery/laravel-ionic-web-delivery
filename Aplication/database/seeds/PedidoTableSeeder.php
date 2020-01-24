<?php

use Illuminate\Database\Seeder;
use WebDelivery\Models\Pedido;
use WebDelivery\Models\PedidoItem;

class PedidoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Pedido::class, 10)->create()->each(function ($p){
            for($i = 0; $i <=3; $i++){
                $p->itens()->save(factory(PedidoItem::class)->make([
                    'produto_id' => rand(1,5),
                    'qtd'=>2,
                    'preco' =>50
                ]));
            }
        });
    }
}
        