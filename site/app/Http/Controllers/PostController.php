<?php

namespace site\Http\Controllers;

use Illuminate\Http\Request;
use Auth;


class PostController extends Controller
{

  public function novoPost() {
    return view('novoPostView');
  }

  public function salvar_novoPost(Request $req) {

    $req->validate([
    'texto' => 'required',
    'conteudo' => 'required',
    ]);

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
    return view('editarPost', ['post' => $post]);
  }

  public function salvar_editarPost(Request $req) {

    if ($req->user()->id != Auth::user()->id) {
      echo "Tu num pode editar sá mundenga não";
    } else {

      $post = \site\Post::find($req->id);

      $post->conteudo = $req->conteudo;
      $post->update();
      return redirect('/home/listarPosts');
    }

  }

  public function listarPosts() {

    $user = Auth::user();

    $posts = $user->getPosts($user->id);

    return view('listarPosts', ['posts' => $posts]);

  }

  public function deletarPost($post_id) {

    $user = Auth::user();
    $post = \site\Post::find($post_id);
    if ($post && $post->id_autor == $user->id) {
      $post->delete();
    } else {
      echo 'Pode fazer isso não rapaz';
    }
    return redirect('/home/listarPosts');
  }
}
