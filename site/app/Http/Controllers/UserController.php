<?php

namespace site\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use site\User;
use Auth;

class UserController extends Controller {

   public function mostrarPerfil() {
      //Não precisa de verificação
      $user = Auth::user();
      $perfisExternos = $user->getPerfisExternos;
      $curadorias = $user->getCuradorias;
      return view('user/mostrarPerfil', ["user" => $user, "perfisExternos" => $perfisExternos, "curadorias" => $curadorias]);
   }

   public function editar($id_user) {
      $user = User::find($id_user);

      if($id_user != $user->id) {
         //Se bem que isso aqui vai apenas mostrar as informações do perfil
            return view('mensagemErro', ['msg' => "Você não pode editar perfis de outro usuários!"]);
      }

      $perfisExternos = $user->getPerfisExternos;
      $curadorias = $user->getCuradorias;
      return view('user/editarUser', ["user" => $user, "perfisExternos" => $perfisExternos, "curadorias" => $curadorias]);
   }

   public function salvarEdicao(Request $request) {
      //Validar Request

      //Verifica se o usuário atual é o dono dos dados a serem alterados
      if(Auth::user()->id != $request->id) {
            return view('mensagemErro', ['msg' => "Você não pode editar perfis de outro usuários!"]);
      }

      $user = \site\User::find($request->id);
      $user->name = $request->name;
      $user->email = $request->email;
      $user->password = $request->password;
      $user->foto = $request->foto;
      $user->descricao = $request->descricao;
      $user->update();
      return redirect('/usuario/mostrarPerfil'); //Essa variável no meio vai funcionar?
   }

   public function deletar($id_user) {
      $user = User::find($id_user);
      if(Auth::user()->id != $id_user) {
            return view('mensagemErro', ['msg' => "Você não pode deletar outros usuários!"]);
      }

      //Deixa de ser moderador dos grupos que ele é moderador
      foreach($user->getGrupos as $grupo) {
         if($grupo->getModeradores->contains($id_user) && $grupo->getModeradores->count() == 1){
                return view('mensagemErro', ['msg' => "Você é o único moderador do grupo ~". $grupo->name ."~.
                Apague-o ou promova algum membro à Moderador. Um Grupo não pode ficar sem moderador!"]);
         }
      }

      $posts  = \site\Post::where('id_autor', $id_user)->get();
      //Apaga todos os comentários dos posts daquele usuário
      foreach ($posts as $p) {
         $comentariosDoPostDele = \site\Comentario::where('id_post', $p->id)->delete();
         //Apaga post um a um
         $p->delete();
      }

      //Apaga todos os comentarios dele em posts de outros usuários
      $comentariosDeleEmOutrosPosts = \site\Comentario::where('id_autor', $id_user)->delete();

      //Deleta os perfis externos
      $perfis = \site\PerfilExternoUser::where('user_id', $id_user)->delete();
      //Deleta as curadorias
      $curadoria = \site\Curadoria_usuario::where('id_user', $id_user)->delete();

      //Apagar amizades
      $amizades = $user->getAmigos;
      foreach ($amizades as $a) {
         // echo $a->id;
         $amigo = \site\User::find($a->id);
         $amigo->getAmigos()->detach($user->id);
         $user->getAmigos()->detach($amigo->id);
      }

      //Deletar Solicitações de Amizades
      $solicitacoesAmizades = $user->getSolicitacoes;
      foreach ($solicitacoesAmizades as $s) {
         $amigo = \site\User::find($s->id);
         $amigo->getSolicitacoes()->detach($user->id);
         $user->getSolicitacoes()->detach($amigo->id);
      }

      //Apaga todas as solicitações de grupo
      foreach($user->getPedidosGruposEnviado as $solicitacao) {
         $user->getPedidosGruposEnviado()->detach($solicitacao->id_grupo_solicitado);
      }

      //Deixa de ser membro dos grupos que ele é membro
      foreach($user->getGrupos as $grupos) {
          $grupos->getMembros()->detach($id_user);
      }

      foreach($user->getGrupos as $grupo) {
         if ($grupo->getModeradores->contains($id_user)) {
            $grupo->getModeradores()->detach($id_user);
         }
      }

      $user->delete();
      redirect ('/home');
   }
}
