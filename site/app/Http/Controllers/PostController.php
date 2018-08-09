<?php

namespace site\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Post;
use Comentario;


class PostController extends Controller
{

   public function novoPost() {
      return view('posts/novoPostView');
   }

   public function salvar_novoPost(Request $req) {
      //Não precisa de verificação. (Além da do Request)

      $req->validate(\site\Post::getRules(), \site\Post::getMsgs());

      $user = Auth::user();
      $post = new \site\Post();
      $post->permanente = false;
      $post->e_de_grupo = false;
      $post->texto = $req->texto;
      $post->conteudo = $req->conteudo;
      $post->id_autor = $user->id;

      $post->save();

      return redirect('/home');
   }

   public function editarPost($post_id) {

      $post = \site\Post::find($post_id);

      if ($post->id_autor != Auth::user()->id) {
         return view('mensagemErro', ['msg' => "Você não tem permissão para editar posts de outros usuários!"]);
      }

      return view('user/editarPost', ['post' => $post]);
   }

   public function salvar_editarPost(Request $req) {

      $req->validate(\site\Post::getRules(), \site\Post::getMsgs());
      $post = \site\Post::find($req->id);

      //Se não encontrou o post
      if(!$post) {
         return view('mensagemErro', ['msg' => "Algo está errado."]);
      }

      //Verifica se o usuário logado é o autor do post
      if ($post->id_autor != Auth::user()->id) {
         return view('mensagemErro', ['msg' => "Você não tem permissão para editar posts de outros usuários!"]);
      }

      $post->conteudo = $req->conteudo;
      $post->update();
      return redirect('/home/listarPosts');
   }

   public function listarPosts() {

      $user = Auth::user();

      $posts = $user->getPosts($user->id);

      return view('posts/listarPosts', ['posts' => $posts]);

   }

   public function deletarPost($post_id) {

      $user = Auth::user();
      $post = \site\Post::find($post_id);

      //Se não encontrou o post
      if(!$post) {
         return view('mensagemErro', ['msg' => "Algo está errado. Post não encontrado!"]);
      }

      //Verifica se o usuário logado é o autor do post
      if ($post->id_autor != Auth::user()->id) {
         return view('mensagemErro', ['msg' => "Você não tem permissão para deletar posts de outros usuários!"]);
      }

      //Deleta os comentários daquele post
      $comentarios = \site\Comentario::where('id_post', $post_id)->delete();
      $post->delete();
      return redirect('/home/listarPosts');
   }


   public function verPost($post_id) {
      $post = \site\Post::find($post_id);

      //Se o post não existe
      if(!$post) {
         return view('mensagemErro', ['msg' => 'Esse post não existe!']);
      }

      $comentarios = $post->getComentarios();
      //Pega os autores
      $autores = $comentarios->map(function($c) {
         $obj = new \site\Comentario();
         $obj->id_autor = $c->id_autor;
         $obj->id_post = $c->id_post;
         $obj->conteudo = $c->conteudo;
         $obj->avaliacao = 0;
         return $obj->getAutor();
      });
      return view('posts/verPost', ['post' => $post, 'comentarios' => $comentarios, 'autores' => $autores]);
   }


}
