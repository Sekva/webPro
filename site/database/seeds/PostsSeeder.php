<?php

use Illuminate\Database\Seeder;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('posts')->insert([
        'permanente' => 0,
        'e_de_grupo' => 0,
        'texto' => 'titulo',
        'conteudo' => 'asdasdasdasd oi qew',
        'id_autor' => 13
      ]);

      DB::table('posts')->insert([
        'permanente' => 0,
        'e_de_grupo' => 0,
        'texto' => 'titulo 2',
        'conteudo' => 'asdasdasdasd oi dnv qew',
        'id_autor' => 13
      ]);
    }
}
