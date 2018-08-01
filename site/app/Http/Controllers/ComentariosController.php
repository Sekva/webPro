<?php

namespace site\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class ComentariosController extends Controller {

   public function comentar(Request $req) {
      if (Auth::user()->id != $req->user_id) {
         return redirect('/home');
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
         echo "Tá mexendo onde não pode rapá?!";
      } else {
         $coment->delete();
         return redirect()->back();
      }
   }


}
