<?php

namespace site\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

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

    public function coisa() {}

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

}
