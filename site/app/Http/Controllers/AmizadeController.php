<?php

namespace site\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use Illuminate\Support\Facades\DB;

class AmizadeController extends Controller {

   private function esseUsuarioExiste($id_user){
      $user = \site\User::find($id_user);
      if ($user) {
         return true;
      } else {
         return false;
      }
   }

   private function euSoliciteiEle($id_user) {
      //Quem guarda a solicitação é quem foi solicitado, não quem enviou
      return \site\User::find($id_user)->getSolicitacoes->contains(Auth::user()->id);
   }

   private function eleMeSolicitou($id_user) {
      //Quem guarda a solicitação é quem foi solicitado, não quem enviou
      return Auth::user()->getSolicitacoes->contains(\site\User::find($id_user)->id);
   }

   private function jaSaoAmigos($id_user) {
      return Auth::user()->getAmigos->contains($id_user);
   }

   public function listarAmigos() {
      //Não precisa fazer verificação
      return view('amizades/listarAmigos', ['listaAmigos' => Auth::user()->getAmigos, 'id' => Auth::user()->id]);
   }

   public function listarTodosUsers() {
      //Não precisafazer verificação
      $users = \site\User::paginate(5);
      return view('amizades/listarTodosUsers', ['users' => $users]);
   }

   public function listarAmigosDeOutro($id) {

      //Verifica se o usuário existe
      if($this->esseUsuarioExiste($id) == false) {
         return "Esse usuário não existe";
      }

      $user = \site\User::find($id);
      return view('amizades/listarAmigos', ['listaAmigos' => $user->getAmigos, 'id' => $id]);
   }

   public function verAmigo($id) {

      //Verifica se o usuário existe
      if($this->esseUsuarioExiste($id) == false) {
         return "Esse usuário não existe";
      }

      $user = \site\User::find($id);
      return view('amizades/exibirUsuario', ['user' => $user]);
   }

   public function solicitarAmizade($id) {
      $user = Auth::user();

      //Verifica se ele está solicitando ele mesmo
      if($user->id == $id){
         return "Não dá pra tu ser amigo de tu mermo! kk";
      }

      //Verifica se o usuário existe
      if($this->esseUsuarioExiste($id) == false) {
         return "Esse usuário não existe";
      }

      //Verifica se já são amigos
      if ($this->jaSaoAmigos($id) == true) {
         return 'Vocês já são amigos';
      }

      //Verifica se ele já foi solicitado
      if($this->euSoliciteiEle($id) == true) {
         return "Essa solicitação já existe!";
      }

      $solicitacoes =$user->getPedidosAmizadeEnviados();
      $solicitacoes->attach($id);
      return redirect()->back();
   }

   public function cancelarSolicitacao($id_solicitado) {

      //Verifica se o usuário existe
      if($this->esseUsuarioExiste($id_solicitado) == false) {
         return "Esse usuário não existe";
      }

      //Verifica se já são amigos
      if ($this->jaSaoAmigos($id_solicitado) == true) {
         return 'Vocês já são amigos';
      }

      //Verifica se a solicitação existe
      if($this->euSoliciteiEle($id_solicitado) == false) {
         return "Essa solicitação não existe. Talvez tenha sido recusada.";
      }

      Auth::user()->getPedidosAmizadeEnviados()->detach($id_solicitado);
      return redirect()->back();
   }

   public function aceitarAmizade($idPedinte) {

      //Verifica se o usuário existe
      if($this->esseUsuarioExiste($idPedinte) == false) {
         return "Esse usuário não existe";
      }

      //Verifica se ele foi solicitado
      if($this->eleMeSolicitou($idPedinte) == false) {
         return "Essa solicitação não existe mais!";
      }

      $pedinte = \site\User::find($idPedinte);
      $pedinte->getPedidosAmizadeEnviados()->detach(Auth::user()->id);

      $pedinte->getAmigos()->attach(Auth::user());
      Auth::user()->getAmigos()->attach($idPedinte);

      return redirect()->back();
   }

   public function recusarAmizade($idPedinte) {

      //Verifica se o usuário existe
      if($this->esseUsuarioExiste($idPedinte) == false) {
         return "Esse usuário não existe";
      }

      //Verifica se ele foi solicitado
      if($this->eleMeSolicitou($idPedinte) == false) {
         return "Essa solicitação não existe mais!";
      }

      $pedinte = \site\User::find($idPedinte);
      $pedinte->getPedidosAmizadeEnviados()->detach(Auth::user()->id);

      return redirect()->back();
   }

   public function listarPedidosPraMim()  {
      //Não precisa de verificação
      return view('amizades/listarPedidosPraMim', ['lista' => Auth::user()->getSolicitacoes]);
   }

   public function desfazerAmizade($id) {
      $user = Auth::user();

      //Verifica se o usuário existe
      if($this->esseUsuarioExiste($id) == false) {
         return "Esse usuário não existe";
      }

      //Verifica se não são mais amigos
      if ($this->jaSaoAmigos($id) == false) {
         return 'Vocês não são mais amigos. Impossível de desfazer uma amizade que não existe mais';
      }

      $user->getAmigos()->detach($id);
      $exAmigo = \site\User::find($id);
      $exAmigo->getAmigos()->detach($user->id);
      return redirect()->back();
   }

   public function perfisExternosAmigos($id) {

      //Verifica se o usuário existe
      if($this->esseUsuarioExiste($id) == false) {
         return "Esse usuário não existe";
      }

      //Verifica se não são mais amigos
      if ($this->jaSaoAmigos($id) == false) {
         return 'Vocês não são mais amigos';
      }

      $amigo = \site\User::find($id);
      $perfis = $amigo->getPerfisExternos;
      return view('amizades/perfilExternosAmigos', ['perfis' => $perfis, 'amigo' => $amigo]);
   }

   public function curadoriasAmigos($id) {

      //Verifica se o usuário existe
      if($this->esseUsuarioExiste($id) == false) {
         return "Esse usuário não existe";
      }

      //Verifica se não são mais amigos
      if ($this->jaSaoAmigos($id) == false) {
         return 'Vocês não são mais amigos';
      }

      $amigo = \site\User::find($id);
      $curadorias = $amigo->getCuradorias;
      return view('amizades/curadoriasAmigos', ['curadorias' => $curadorias, 'amigo' => $amigo]);
   }

}
