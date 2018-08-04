<?php

namespace site\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use User;

class PerfilExternoController extends Controller{

    public function salvar_perfilExterno(Request $req) {

      $req->validate(\site\PerfilExternoUser::getRules(), \site\PerfilExternoUser::getMsgs());


      $user = Auth::user();
      $perfilExterno = new \site\PerfilExternoUser();
      $perfilExterno->nome = $req->nome;
      $perfilExterno->link = $req->link;
      $user->getPerfisExternos()->save($perfilExterno);
      return redirect('home');
    }

    public function novoPerfilExterno() {
      return view('user/novoPerfilExterno');
    }

    public function perfilExterno() {
      $user = Auth::user();
      $perfisExterno = $user->getPerfisExternos;
      return view('perfilExterno', ['perfisExterno' => $perfisExterno]);
    }

    public function editarPerfilExterno($perfil_id) {

      $perfil = \site\PerfilExternoUser::find($perfil_id);

      if(!$perfil) {
        return "passaram um argumento com o id de um prefil que nao existe";
      } else {
        //return $perfil;
        return view('user/editarPerfilExterno', ['perfil_externo' => $perfil]);
      }
    }

    public function salvar_perfilExternoEdit(Request $req) {

      $req->validate(\site\PerfilExternoUser::getRules(), \site\PerfilExternoUser::getMsgs());


      $perfil = \site\PerfilExternoUser::find($req->id);
      $perfil->nome = $req->nome;
      $perfil->link = $req->link;
      $perfil->save();
      return redirect('/home');
    }

    public function apagarPerfilExterno($id) {
      $perfil = \site\PerfilExternoUser::find($id);
      $perfil->delete();
      return redirect('/home');
    }


}
