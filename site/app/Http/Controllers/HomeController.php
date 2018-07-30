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
