<?php

namespace site\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

use Auth;
use site\User;
use site\Perfis_externos;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function novoPerfilExterno() {
      return view('novoPerfilExterno');
    }

    public function perfilExterno() {
      $user = Auth::user();
      $perfisExterno = $user->getPerfisExternos;
      return view('perfilExterno', ['perfisExterno' => $perfisExterno]);
    }

    public function mudarFotoPerfilView() {
      return view('mudarFotoPerfil');
    }

    public function salvar_fotoPerfil(Request $req) {
      $user = Auth::user();
      $caminho = '/storage/defaul.png';
      if ($req->hasFile('foto')) {
        $caminho = Storage::putFileAs(
          'public', $req->file('foto'), $user->id
        );
        $user->foto = '/storage/' . $user->id;
        $user->save();
        return redirect('/home');
      } else {
        echo 'Deu probleminha com a foto ai';
      }
    }

    public function editarPerfilExterno($perfil_id) {

      $perfil = \site\PerfilExternoUser::find($perfil_id);

      if(!$perfil) {
        return "passaram um argumento com o id de um prefil que nao existe";
      } else {
        //return $perfil;
        return view('editarPerfilExterno', ['perfil_externo' => $perfil]);
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
