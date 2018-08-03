<?php

namespace site\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use site\User;
use Auth;

class UserController extends Controller {

   public function mostrarPerfil(User $user) {
      $user = Auth::user();
      $perfisExternos = $user->getPerfisExternos;
      $curadorias = $user->getCuradorias;
      return view('mostrarPerfil', ["user" => $user, "perfisExternos" => $perfisExternos, "curadorias" => $curadorias]);
   }

   public function editar($id_user) {
      $user = User::find($id_user);

      $this->authorize('editarUser', $user);
      $perfisExternos = $user->getPerfisExternos;
      $curadorias = $user->getCuradorias;
      return view('editarUser', ["user" => $user, "perfisExternos" => $perfisExternos, "curadorias" => $curadorias]);
   }

   public function salvarEdicao(Request $request) {
      $this->authorize('editarUser', $request);

      $user = \site\User::find($request->id);

      $user->name = $request->name;
      $user->email = $request->email;
      $user->password = $request->password;
      $user->foto = $request->foto;
      $user->descricao = $request->descricao;
      $user->update();
      return redirect('/usuario/mostrarPerfil'); //Essa variável no meio vai funcionar?
   }

   public function checarDeletar() {
      return view('deletar');
   }

   public function deletar($id_user) {
      $user = User::find($id_user);
      if($user->id == $id_user) {
         $posts  = \site\Post::where('id_autor', $id_user)->get();
         //Apaga todos os comentários dos posts daquele usuário
         foreach ($posts as $p) {
            $comentariosDoPostDele = \site\Comentario::where('id_post', $p->id)->delete();
            //Apaga post um a um
            $p->delete();
         }
         //Apaga todos os comentarios daquele post
         $comentariosDeleEmOutrosPosts = \site\Comentario::where('id_autor', $id_user)->delete();

         $perfis = \site\PerfilExternoUser::where('user_id', $id_user)->delete();
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

         foreach($user->getPedidosGruposEnviado as $solicitacao) {
            $user->getPedidosGruposEnviado()->detach($solicitacao->id_grupo_solicitado);
         }

         //Deixa de ser membro dos grupos que ele é membro
         foreach($user->getGrupos as $grupos) {
             $grupos->getMembros()->detach($id_user);
         }
         //Deixa de ser moderador dos grupos que ele é moderador
         foreach($user->getGrupos as $grupos) {
            if($grupo->getModeradores->contains($id_user) && $grupos->getModeradores()->count() == 1){
               return "Você é o único moderador do grupo _". $grupos->name ."~. Apague-o ou promova algum membro à Moderador.";
            }
         }

         foreach($user->getGrupos as $grupo) {
            if ($grupo->getModeradores->contains($id_user)) {
               $grupo->getModeradores()->detach($id_user);
            }
         }

         $user->delete();
      } else {
         return redirect('/home/listarPosts');
      }
      echo "deletado";
      // return redirect('/home');
   }
}
