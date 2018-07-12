<?php

namespace site\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use site\User;

class UserController extends Controller {

    public function editar($id) {
			$user = \site\User::find($id);
    		return view("editarUser", ['user' => $user]);
    }

    public function salvar(Request $request) {
        $user = \site\User::find($request->id);
        $user->nome = $request->nome;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->foto = $request->foto;
        $user->descricao = $request->descricao;

        return redirect("/mostrarUsers");
    }

    public function mostrarUsers(User $user) {
        $users = $user->all();

        return view('mostrarUsers', compact('users'));
    }
}
