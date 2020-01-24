<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(EmpresaTableSeeder::class);
        $this->call(UsuarioTableSeeder::class);
        $this->call(CategoriaTableSeeder::class);
        $this->call(ComponenteTableSeeder::class);
        $this->call(PedidoTableSeeder::class);
        $this->call(CupomTableSeeder::class);
        $this->call(AppTableSeeder::class);
        Model::reguard();
    }
}
