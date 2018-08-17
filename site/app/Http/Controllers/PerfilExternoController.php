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
      return redirect('/home/perfilExterno');
    }

    public function novoPerfilExterno() {
      return view('user/novoPerfilExterno');
    }

    public function perfilExterno() {
      //Não precisa de verificação
      $user = Auth::user();
      $perfisExterno = $user->getPerfisExternos;
      return view('perfilExterno', ['perfisExterno' => $perfisExterno]);
    }

    public function editarPerfilExterno($perfil_id) {

      $perfil = \site\PerfilExternoUser::find($perfil_id);

      //Se não encontrar o perfil externo buscado
      if(!$perfil) {
         return view('mensagemErro', ['msg' => "Perfil Externo não encontrado!"]);
      }

      //Se ele não for o dono do perfil externo
      if(Auth::user()->id != $perfil->user_id) {
         return view('mensagemErro', ['msg' => "Você não tem permissão para alterar esse Perfil Externo!"]);
      }

      return view('user/editarPerfilExterno', ['perfil_externo' => $perfil]);
    }

    public function salvar_perfilExternoEdit(Request $req) {

      //Se ele é o dono do perfil externo do request
      if(Auth::user()->id != $req->id) {
         return view('mensagemErro', ['msg' => "Você não tem permissão para salvar esse Perfil Externo!"]);
      }

      $req->validate(\site\PerfilExternoUser::getRules(), \site\PerfilExternoUser::getMsgs());

      $perfil = \site\PerfilExternoUser::find($req->id);
      $perfil->nome = $req->nome;
      $perfil->link = $req->link;
      $perfil->save();
      return redirect('/home/perfilExterno');
    }

    public function apagarPerfilExterno($id) {
      $perfil = \site\PerfilExternoUser::find($id);

      if(Auth::user()->id != $perfil->user_id) {
         return view('mensagemErro', ['msg' => "Você não tem permissão para deletar esse perfil!"]);
      }

      $perfil->delete();
      return redirect('/home/perfilExterno');
    }


}
