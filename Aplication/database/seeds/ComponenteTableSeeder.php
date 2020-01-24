<?php

use Illuminate\Database\Seeder;
use WebDelivery\Models\Componente;

class ComponenteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Componente::class, 30)->create()->make();
    }
}
