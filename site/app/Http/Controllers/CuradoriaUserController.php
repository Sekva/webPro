<?php

namespace site\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class CuradoriaUserController extends Controller {

  public function listarCuradorias() {
    $user = Auth::user();
    $curadorias = $user->getCuradorias;
    return view('minhasCuradorias', ["curadorias" => $curadorias]);
  }

  public function novaCuradoria() {
    return view('novaCuradoria');
  }

  public function salvarNovaCuradoria(Request $req) {

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
      return "num existe";
    } else {
      return view('editarCuradoria', ["curadoria" => $curadoria]);
    }

  }

  public function salvarEditCuradoria(Request $req) {

     $req->validate(\site\Curadoria_usuario::getRules(), \site\Curadoria_usuario::getMsgs());


    $curadoria = \site\Curadoria_usuario::find($req->id);

    if ($curadoria) {
      $curadoria->nome = $req->nome;
      $curadoria->descricao = $req->descricao;
      $curadoria->link = $req->link;
      $curadoria->save();
      return redirect('/home/curadorias');
    } else {
      return "request mei errado";
    }
  }

  public function apagarCuradoria($id) {
    $curadoria = \site\Curadoria_usuario::find($id);
    $curadoria->delete();
    return redirect('/home/curadorias');
  }

}
