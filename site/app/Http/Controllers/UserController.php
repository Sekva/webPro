<?php

namespace site\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use site\User;
use Auth;

class UserController extends Controller {

    public function mostrarPerfil(User $user) {
        $user = Auth::user();
        $perfisExterno = $user->getPerfisExternos;
        return view('mostrarPerfil', ["user" => $user, "perfisExterno" => $perfisExterno]);
    }

    public function editar($id_user) {
        $user = User::find($id_user);

        $this->authorize('editarUser', $user);
        $perfisExterno = $user->getPerfisExternos;
        return view('editarUser', ["user" => $user, "perfisExterno" => $perfisExterno]);
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
            $posts=\site\Post::where('id_autor', $id_user)->delete();
            $posts=\site\PerfilExternoUser::where('user_id',$id_user)->delete();
            $user->delete();
        } else {
            return redirect('/home/listarPosts');
        }
        return redirect('/home');
    }
}
