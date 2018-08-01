<?php

namespace site\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class GrupoController extends Controller {

   public function listarGrupos() {
      $user = Auth::user();
      $grupos = $user->getGrupos;
      return view('grupo/listarGrupos', ['grupos' => $grupos, 'id' => $user->id]);
   }

   public function novoGrupo() {
      return view('grupo/novoGrupo');
   }

   public function salvar_novoGrupo(Request $req) {
      //valida a request

      $grupo = new \site\Grupo();
      $grupo->name = $req->name;
      $grupo->foto = $req->foto;
      $grupo->descricao = $req->descricao;
      $grupo->save();

      $grupo->getMebros()->attach(Auth::user()->id);
      $grupo->getModeradores()->attach(Auth::user()->id);
      return redirect('/grupos');
   }

   public function listarTodosGrupos() {
      $grupos = \site\Grupo::all();
      return view('grupo/listarTodosGrupos', ['grupos' => $grupos, 'user' => Auth::user()]);
   }

   public function solicitarEntradaEmGrupo($id_grupo) {
      //valida se o grupo ta certo e veja e já n é membro
      $grupo = \site\Grupo::find($id_grupo);
      $grupo->getSolicitacoes()->attach(Auth::user()->id);
      return redirect()->back();
   }

   public function aceitarSolicitacao($id_user, $id_grupo) {
      //veja se o user ainda existe
      //veja se o cara q ta logado pode fazer isso (pertences  a moderadores)
      //veja se o grupo existe tbm
      $grupo = \site\Grupo::find($id_grupo);
      $grupo->getSolicitacoes()->detach($id_user);
      $grupo->getMebros()->attach($id_user);
      return redirect('/home');
   }

   public function sairDoGrupo($id_grupo) {
      //valide se o cara ta logado e se o grupo existe
      $grupo = \site\Grupo::find($id_grupo);
      $grupo->getMebros()->detach(Auth::user()->id);

      if ($grupo->getModeradores->contains(Auth::user()->id)) {
         $grupo->getModeradores()->detach(Auth::user()->id);
      }

   }

   public function removerDoGrupo($id_grupo, $id_user) {
      //veja se as coisa existe
      //veje se o cara q ta fazenod isso é moderador
      $grupo = \site\Grupo::find($id_grupo);
      $grupo->getMebros()->detach($id_user);

      if ($grupo->getModeradores->contains($id_user)) {
         $grupo->getModeradores()->detach($id_user);
      }

   }

}
