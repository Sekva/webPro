<?php

use Illuminate\Database\Seeder;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

      $post1 = new \site\Post();

      $post1->permanente = false;
      $post1->e_de_grupo = false;
      $post1->texto = "kasdhds";
      $post1->conteudo = "ijifdo";

      $user = \site\User::find(1);
      $user->posts()->save($post1);

    }
}
