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

   public function listarSolicitacoes($id_grupo) {
      //veja se o logado é moderador
      //veja se tudo existe
      $grupo = \site\Grupo::find($id_grupo);
      $solicitacoes = $grupo->getSolicitacoes;
      return view('grupo/listarSolicitacoes', ['grupo' => $grupo, 'solicitacoes' => $solicitacoes]);
   }

   public function aceitarSolicitacao($id_user, $id_grupo) {
      //veja se o user ainda existe
      //veja se o cara q ta logado pode fazer isso (pertences  a moderadores)
      //veja se o grupo existe tbm
      $grupo = \site\Grupo::find($id_grupo);
      $grupo->getSolicitacoes()->detach($id_user);
      $grupo->getMebros()->attach($id_user);
      return redirect()->back();
   }

   public function sairDoGrupo($id_grupo) {
      //valide se o cara ta logado e se o grupo existe
      $grupo = \site\Grupo::find($id_grupo);
      $grupo->getMebros()->detach(Auth::user()->id);

      if ($grupo->getModeradores->contains(Auth::user()->id)) {
         $grupo->getModeradores()->detach(Auth::user()->id);
      }
      return redirect('/grupos');
   }

   public function removerDoGrupo($id_grupo, $id_user) {
      //veja se as coisa existe
      //veje se o cara q ta fazenod isso é moderador
      $grupo = \site\Grupo::find($id_grupo);
      $grupo->getMebros()->detach($id_user);

      if ($grupo->getModeradores->contains($id_user)) {
         $grupo->getModeradores()->detach($id_user);
      }
      return redirect('/grupos');
   }

   public function verGrupo($id_grupo) {
      //veja se o user pode ver o grupo
      //veja se o grupo existe

      $grupo = \site\Grupo::find($id_grupo);
      // echo $grupo;
      return view('grupo/homeGrupo', [ 'grupo' => $grupo]);
   }

   public function novoPost($id_grupo) {
      //veja se o grupo existe
      $grupo = \site\Grupo::find($id_grupo);
      return view('grupo/novoPost', ['grupo' => $grupo]);
   }

   public function salvar_novoPost(Request $req) {
      //valide essa resquest

      $user = Auth::user();

      $post = new \site\Post();

      //só moderador pode fazer um permanente

      if ($req->permanente == 'on') {
         $post->permanente = 1;
      } else {
         $post->permanente = 0;
      }

      $post->e_de_grupo = true;
      $post->texto = $req->texto;
      $post->conteudo = $req->conteudo;
      $post->id_autor = $user->id;
      $post->save();

      $grupo = \site\Grupo::find($req->id_grupo);
      $grupo->getPosts()->attach($post->id);

      return redirect('/grupos/ver/'.$req->id_grupo);

   }

   public function listarMembros($id_grupo) {
      $grupo = \site\Grupo::find($id_grupo);
      $amigos = $grupo->getMebros;
      return view('grupo/listarMembros', ['listaAmigos' => $amigos, 'grupo' => $grupo]);
   }

   public function listarModeradores($id_grupo) {
      $grupo = \site\Grupo::find($id_grupo);
      $moderadores = $grupo->getModeradores;
      return view('grupo/listarModeradores', ['listaAmigos' => $moderadores]);
   }

   public function listarPerfisExternos($id_grupo) {
      //ve se o grupo existe mrm
      $grupo = \site\Grupo::find($id_grupo);
      $perfis = $grupo->getPerfisExterno;
      return view('grupo/listarPerfilExterno', ['grupo' => $grupo, 'perfisExterno' => $perfis]);
   }

   public function novoPerfilExterno($id_grupo) {
      //veja se o grupo existe mrm
      //só moderador pode fazer isso
      $grupo = \site\Grupo::find($id_grupo);
      return view('grupo/novoPerfilExterno', ['grupo' => $grupo]);
   }

   public function salvar_novoPerfilExterno(Request $req) {
      //valida
      $perfil = new \site\PerfilExternoGrupo();
      $perfil->nome = $req->nome;
      $perfil->link = $req->link;
      $perfil->grupo_id = $req->id_grupo;
      $perfil->save();
      return redirect('/grupos/ver/'.$req->id_grupo);
   }

   public function apagarPerfilExterno($id_perfil, $id_grupo) {
      //só moderadores podem

      $perfil = \site\PerfilExternoGrupo::find($id_perfil);

      if ($perfil) {
         $perfil->delete();
      }

      return redirect()->back();

   }

   public function editarPerfilExterno($id_perfil, $id_grupo) {
      //só moderador pode fazer isso

      $grupo = \site\Grupo::find($id_grupo);
      $perfil = \site\PerfilExternoGrupo::find($id_perfil);

      return view('grupo/editarPerfilExterno', ['grupo' => $grupo, 'perfil_externo' => $perfil]);
   }

   public function salvar_editarPerfilExterno(Request $req) {
      //valida a request

      $perfil = \site\PerfilExternoGrupo::find($req->id);
      $perfil->nome = $req->nome;
      $perfil->link = $req->link;
      $perfil->save();
      return redirect('grupos/ver/' . $req->id_grupo);

   }

   public function listarCuradorias($id_grupo) {
      //v se o grupo existe e o cara faz parte
      $grupo = \site\Grupo::find($id_grupo);
      $curadorias = $grupo->getCuradorias;
      return view('grupo/listarCuradorias', ['grupo' => $grupo, 'curadorias' => $curadorias]);

   }

   public function novaCuradoria($id_grupo) {
      //só o moderador pode
      //v se o grupo exites mmr

      $grupo = \site\Grupo::find($id_grupo);

      return view('grupo/novaCuradoria', ['grupo' => $grupo]);
   }

   public function salvar_novaCuradoria(Request $req) {
      //já sabe q tem q validar né sekva?

      $curadoria = new \site\Curadoria_grupos();
      $curadoria->nome = $req->nome;
      $curadoria->link = $req->link;
      $curadoria->descricao = $req->descricao;
      $curadoria->id_grupo = $req->id_grupo;
      $curadoria->save();

      return redirect('grupos/ver/' . $req->id_grupo);

   }

   public function apagarCuradoria($id_curadoria, $id_grupo) {
      //v se o carar é moderador do grupo e se tudo existe

      $curadoria = \site\Curadoria_grupos::find($id_curadoria);

      if ($curadoria) {
         $curadoria->delete();
      }

      return redirect()->back();

   }

   public function editarCuradoria($id_curadoria, $id_grupo) {
      //v se o carar é moderador do grupo e se tudo existe

      $grupo = \site\Grupo::find($id_grupo);
      $curadoria = \site\Curadoria_grupos::find($id_curadoria);

      return view('grupo/editarCuradoria', ['grupo' => $grupo, 'curadoria' => $curadoria]);


   }

   public function salvar_editarCuradoria(Request $req) {
      //valida a request

      $curadoria = \site\Curadoria_grupos::find($req->id);
      $curadoria->nome = $req->nome;
      $curadoria->link = $req->link;
      $curadoria->descricao = $req->descricao;
      $curadoria->save();
      return redirect('grupos/ver/' . $req->id_grupo);

   }

   public function promoverParaModerador($id_grupo, $id_user) {
      //veja se o cara q ta logado é moderador do grupo
      //veja se o cara já n é moderador
      //veja se o grupo existe
      //veja se o user existe

      $grupo = \site\Grupo::find($id_grupo);
      $grupo->getModeradores()->attach($id_user);

      return redirect()->back();

   }

   public function reduzirModerador($id_grupo, $id_user) {
      //veja se o cara q ta logado é moderador do grupo
      //veja se o cara já n é moderador
      //veja se o grupo existe
      //veja se o user existe

      $grupo = \site\Grupo::find($id_grupo);
      $grupo->getModeradores()->detach($id_user);

      return redirect()->back();

   }

}
