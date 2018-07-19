<?php

namespace site\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use site\User;
use Auth;

class UserController extends Controller {

    public function mostrarPerfil(User $user) {
        $user = Auth::user();
        return view('mostrarPerfil', compact('user'));
    }

    public function editar($id_user) {
        $user = User::find($id_user);

        $this->authorize('editarUser', $user);

        return view('editarUser', compact('user'));
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
            // Cascade >>
            // $posts=Post::where('id',$id_autor)->delete();
            // $posts=Perfis_externos::where('id',$user_id)->delete();
            $user->delete();
        } else {
            return redirect('/home/listarPosts');
        }
        return redirect('/home');
    }
}
