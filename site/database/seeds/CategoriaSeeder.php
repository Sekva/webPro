<?php

use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i=0; $i < 10; $i++) {
          // code...
          DB::table('categorias')->insert(['negocin' => 'asd']);
        }
    }
}
