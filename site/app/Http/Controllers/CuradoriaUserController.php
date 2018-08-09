<?php

namespace site\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class CuradoriaUserController extends Controller {

   public function listarCuradorias() {
      //Não precisa de verificação
      $user = Auth::user();
      $curadorias = $user->getCuradorias;
      return view('user/minhasCuradorias', ["curadorias" => $curadorias]);
   }

   public function novaCuradoria() {
      return view('user/novaCuradoria');
   }

   public function salvarNovaCuradoria(Request $req) {
      //Não precisa de verificação pois o id do usuário não está sendo passado no req

      $req->validate(\site\Curadoria_usuario::getRules(), \site\Curadoria_usuario::getMsgs());

      $user = Auth::user();

      $curadoria = new \site\Curadoria_usuario();
      $curadoria->nome = $req->nome;
      $curadoria->descricao = $req->descricao;
      $curadoria->link = $req->link;

      $user->getCuradorias()->save($curadoria);

      return redirect('/home/curadorias');
   }

   public function editarCuradoria($id) {
      $curadoria = \site\Curadoria_usuario::find($id);

      if (!$curadoria) {
         return view('mensagemErro', ['msg' => "Essa curadoria não existe!"]);
      }

      if(Auth::user()->id != $curadoria->id_user) {
         return view('mensagemErro', ['msg' => "Você não tem permissão para editar curadorias de outras pessoas!"]);
      }

      return view('user/editarCuradoria', ["curadoria" => $curadoria]);
   }

   public function salvarEditCuradoria(Request $req) {

      $req->validate(\site\Curadoria_usuario::getRules(), \site\Curadoria_usuario::getMsgs());

      $curadoria = \site\Curadoria_usuario::find($req->id);

      if (!$curadoria) {
         return view('mensagemErro', ['msg' => "Algo errado aconteceu!"]);
      }

      if(Auth::user()->id != $curadoria->id_user) {
         return view('mensagemErro', ['msg' => "Você não tem permissão para editar curadorias de outras pessoas!"]);
      }

      $curadoria->nome = $req->nome;
      $curadoria->descricao = $req->descricao;
      $curadoria->link = $req->link;
      $curadoria->save();
      return redirect('/home/curadorias');
   }

   public function apagarCuradoria($id) {
      $curadoria = \site\Curadoria_usuario::find($id);

      if(!$curadoria) {
         return view('mensagemErro', ['msg' => "Curadoria inexistente"]);
      }

      if(Auth::user()->id != $curadoria->id_user) {
         return view('mensagemErro', ['msg' => "Você não tem permissão para apagar curadorias de outras pessoas!"]);
      }

      $curadoria->delete();
      return redirect('/home/curadorias');
   }

}
