<?php

namespace site\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use Illuminate\Support\Facades\DB;

class AmizadeController extends Controller {

   public function listarAmigos() {
      return view('listarAmigos', ['listaAmigos' => Auth::user()->getAmigos, 'id' => Auth::user()->id]);
   }

   public function listarTodosUsers() {
      $users = \site\User::paginate(5);
      return view('listarTodosUsers', ['users' => $users]);
   }

   public function listarAmigosDeOutro($id) {
      // valida se o oto existe

      $user = \site\User::find($id);
      return view('listarAmigos', ['listaAmigos' => $user->getAmigos, 'id' => $id]);

   }

   public function verAmigo($id) {
      $user = \site\User::find($id);
      //VALIDA ser usuario existe
      return view('exibirUsuario', ['user' => $user]);
   }

   // public function listarTodosUsers() {
   //    return \site\User::all();
   // }

   public function soilicitarAmizade($id) {
      // valide pq eu n posso solicitar eu mesmo

      $eu_outro = DB::table('amizades')->where('id_user1', Auth::user()->id)->where('id_user2', $id)->get();
      $outro_eu = DB::table('amizades')->where('id_user1', $id)->where('id_user2', Auth::user()->id)->get();

      if (!$eu_outro->isEmpty() && !$outro_eu->isEmpty()) {
         return 'mas já são amiguss';
      }

      $user = Auth::user();
      $destino = \site\User::find($id);

      if (!$destino) {
         return  'destino nem existe';
      }
      $solicitacoes =$user->getPedidosAmizadeEnviados();
      $solicitacoes->attach($id);
      return redirect()->back();
   }

   public function aceitarAmizade($idPedinte) {
      //valide se o pedinte existe

      $pedinte = \site\User::find($idPedinte);
      $pedinte->getPedidosAmizadeEnviados()->detach(Auth::user()->id);

      $pedinte->getAmigos()->attach(Auth::user());
      Auth::user()->getAmigos()->attach($idPedinte);

      return redirect()->back();
   }

   public function listarPedidosPraMim()  {
      return view('listarPedidosPraMim', ['lista' => Auth::user()->getSolicitacoes]);
   }

   //Recebe id do amigo
   public function desfazerAmizade($id) {
      $user = Auth::user();
      //VALIDA se o id é amg mrm
      $user->getAmigos()->detach($id);

      $exAmigo = \site\User::find($id);
      $exAmigo->getAmigos()->detach($user->id);

      return redirect()->back();
   }

   public function cancelarSolicitacao($id_solicitado) {
      // $user = \site\User::find(Auth::user()->id);
      // $solicitacoes = $user->getSolicitacoes()->detach($id_solicitado);

         Auth::user()->getPedidosAmizadeEnviados()->detach($id_solicitado);


      return redirect()->back();
      // $solicitacao = \site\Solicitacao::where('id_quem_pediu', Auth::user()->id)->where('id_quem_recebeu', $id_solicitado);
   }

   public function perfisExternosAmigos($id) {
      //valida se esse id ta certo

      $amigo = \site\User::find($id);
      $perfis = $amigo->getPerfisExternos;
      return view('perfilExternosAmigos', ['perfis' => $perfis, 'amigo' => $amigo]);
   }

   public function curadoriasAmigos($id) {
      //valida se esse id ta certo

      $amigo = \site\User::find($id);
      $curadorias = $amigo->getCuradorias;

      return view('curadoriasAmigos', ['curadorias' => $curadorias, 'amigo' => $amigo]);
   }

}
