<?php

namespace site\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use User;

class PerfilExternoController extends Controller{

    public function salvar_perfilExterno(Request $req) {

      $user = Auth::user();

      $perfilExterno = \site\Perfis_externos::find($user->id_perfil_externo);

      if(!$perfilExterno) {
        $perfilExterno = new \site\Perfis_externos();
      }

      $perfilExterno->nome = $req->nome;
      $perfilExterno->link = $req->link;
      $perfilExterno->save();

      $user->id_perfil_externo = $perfilExterno->id;
      $user->save();

      return redirect('home');

    }

    public function perfilExterno() {

      $user = Auth::user();
      $perfilExterno = $user->getPerfisExternos();

      return view('perfilExterno', ['perfilExterno' => $perfilExterno]);
    }



}
