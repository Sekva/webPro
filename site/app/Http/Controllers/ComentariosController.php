<?php

namespace site\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class ComentariosController extends Controller {

   public function comentar(Request $req) {
      //Não precisa de verificação (Além da do Request)

      $req->validate(\site\Comentario::getRules(), \site\Comentario::getMsgs());

      if (Auth::user()->id != $req->user_id) {
         return view('mensagemErro', ['msg' => 'Ocorreu algum erro!']);
      }

      $coment = new \site\Comentario();
      $coment->id_autor = $req->user_id;
      $coment->id_post = $req->post_id;
      $coment->conteudo = $req->conteudo;
      $coment->avaliacao = 0;

      $coment->save();

      return redirect()->back();
   }

   public function deletar($id_coment) {
      $coment = \site\Comentario::find($id_coment);

      if(Auth::user()->id != $coment->id_autor) {
         return view('mensagemErro', ['msg' => "Você não tem autorização para deletar comentários de outros usuários!"]);
      }

      $coment->delete();
      return redirect()->back();
   }

}
