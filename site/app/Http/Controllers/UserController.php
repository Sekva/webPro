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
               $comentarios = \site\Comentario::where('id_post', $p->id)->delete();
               //Apaga post um a u
               $p->delete();
            }
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
            //Deletar Solicitações
            $solicitacoes = $user->getSolicitacoes;
            foreach ($solicitacoes as $s) {
               $amigo = \site\User::find($s->id);
               $amigo->getSolicitacoes()->detach($user->id);
               $user->getSolicitacoes()->detach($amigo->id);
            }

            $user->delete();
        } else {
            return redirect('/home/listarPosts');
        }
        echo "deletado";
        // return redirect('/home');
    }
}
