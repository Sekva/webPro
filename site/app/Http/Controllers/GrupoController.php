<?php

namespace site\Http\Controllers;

use Illuminate\Http\Request;
// use Illiminate\Contracts\Session\Session
// use Illuminate\Support\Facades\Session;
use Session;
use Auth;
use Illuminate\Support\Facades\DB;


class GrupoController extends Controller {


   private function esseGrupoExiste($id_grupo) {
      $grupo = \site\Grupo::find($id_grupo);
      if(!$grupo) {
         return false;
      }
      return true;
   }

   private function ehModerador($id_grupo, $id_user) {
      $grupo = \site\Grupo::find($id_grupo);
      if($grupo->getModeradores->contains($id_user)) {
         return true;
      }
      return false;
   }

   private function ehMembroDoGrupo($id_grupo, $id_membro) {
      $grupo = \site\Grupo::find($id_grupo);
      if($grupo->getMembros->contains($id_membro)) {
         return true;
      }
      return false;
   }

   private function esseUsuarioExiste($id_user){
      $user = \site\User::find($id_user);
      if ($user) {
         return true;
      } else {
         return false;
      }
   }

   private function essaSolicitacaoExiste($id_grupo, $id_user) {
      $grupo = \site\Grupo::find($id_grupo);
      return $grupo->getSolicitacoes->contains($id_user);

   }

   private function quantidadeDeModeradores($id_grupo) {
      $grupo = \site\Grupo::find($id_grupo);
      $moderadores = $grupo->getModeradores;
      return $moderadores->count();
   }

   private function apagarGrupo($id_grupo) {
      $grupo = \site\Grupo::find($id_grupo);
      if ($grupo) {
         foreach ($grupo->getSolicitacoes as $solicitacao) {
            $grupo->getSolicitacoes()->detach($solicitacao->id);
         }
         foreach ($grupo->getPosts as $post) {
            $grupo->getPosts()->detach($post->id);
         }
         foreach ($grupo->getPerfisExterno as $p) {
            $perfil = \site\PerfilExternoGrupo::find($p->id);
            $perfil->delete();
         }
         foreach ($grupo->getCuradorias as $c) {
            $ca = \site\Curadoria_grupos::find($c->id);
            $ca->delete();
         }

         $grupo->getMembros()->detach(Auth::user()->id);

         if ($grupo->getModeradores->contains(Auth::user()->id)) {
            $grupo->getModeradores()->detach(Auth::user()->id);
         }
      }
   }

   //==========================================

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
      $req->validate(\site\Grupo::getRules(), \site\Grupo::getMsgs());



      $grupo = new \site\Grupo();
      $grupo->name = $req->name;
      $grupo->foto = $req->foto;
      $grupo->descricao = $req->descricao;
      $grupo->save();

      $grupo->getMembros()->attach(Auth::user()->id);
      $grupo->getModeradores()->attach(Auth::user()->id);
      return redirect('/grupos');
   }

   public function listarTodosGrupos() {
      $grupos = \site\Grupo::paginate(5);
      return view('grupo/listarTodosGrupos', ['grupos' => $grupos, 'user' => Auth::user()]);
   }

   public function solicitarEntradaEmGrupo($id_grupo) {
      $user = Auth::user();

      //Se o grupo existir
      if($this->esseGrupoExiste($id_grupo) == false) {
         return "Esse grupo não existe!";
      }

      //Verifica se aquele cara é membro do grupo
      if($this->ehMembroDoGrupo($id_grupo, Auth::user()->id) == true) {
         return "Você já é membro do grupo! ~.~";
      }

      //Se a solicitação dele não existir
      if($this->essaSolicitacaoExiste($id_grupo, $user->id) == true) {
         return "Você já solicitou a entrada nesse grupo";
      }

      $grupo = \site\Grupo::find($id_grupo);
      $grupo->getSolicitacoes()->attach(Auth::user()->id);
      return redirect()->back();
   }

   public function cancelarSolicitacaoDeGrupo($id_grupo) {
      $user = Auth::user();

      //Se o grupo existir
      if($this->esseGrupoExiste($id_grupo) == false) {
         return "Esse grupo não existe!";
      }

      //Se a solicitação dele não existir
      if($this->essaSolicitacaoExiste($id_grupo, $user->id) == false) {
         return "Essa solicitação não existe mais.";
      }

      //Verifica se já foi aceito no grupo (aí não dá mais pra cancelar)
      if($this->ehMembroDoGrupo($id_grupo, $user->id) == true) {
         return "Você já é membro do grupo!";
      }

      $grupo = \site\Grupo::find($id_grupo);
      $grupo->getSolicitacoes()->detach($user->id);

      return redirect()->back();

   }

   public function listarSolicitacoes($id_grupo) {

      //Se o grupo existir
      if($this->esseGrupoExiste($id_grupo) == false) {
         return "Esse grupo não existe!";
      }

      //Verifica se o usuário logado é Moderador
      if($this->ehModerador($id_grupo, Auth::user()->id) == false) {
         return "Você não é Moderador!!";
      }

      $grupo = \site\Grupo::find($id_grupo);
      $solicitacoes = $grupo->getSolicitacoes;
      return view('grupo/listarSolicitacoes', ['grupo' => $grupo, 'solicitacoes' => $solicitacoes]);
   }

   public function aceitarSolicitacao($id_user, $id_grupo) {

      //Se o grupo existir
      if($this->esseGrupoExiste($id_grupo) == false) {
         return "Esse grupo não existe!";
      }

      //Verifica se o usuário logado é Moderador
      if($this->ehModerador($id_grupo, Auth::user()->id) == false) {
         return "Você não é Moderador!!";
      }

      //Se a solicitação existir
      if($this->essaSolicitacaoExiste($id_grupo, $id_user) == false) {
         return "Essa solicitação não existe mais";
      }

      if($this->esseUsuarioExiste($id_user) == false) {
         return "Usuário inexistente!";
      }

      //Verifica se aquele cara é membro do grupo
      if($this->ehMembroDoGrupo($id_grupo, $id_user) == true) {
         $grupo = \site\Grupo::find($id_grupo);
         $grupo->getSolicitacoes()->detach($id_user);
         return "Mas esse cara já é membro";
      }

      $grupo = \site\Grupo::find($id_grupo);
      $grupo->getSolicitacoes()->detach($id_user);
      $grupo->getMembros()->attach($id_user);
      return redirect()->back();
   }

   public function recusarSolicitacao($id_user, $id_grupo) {

      //Se o grupo existir
      if($this->esseGrupoExiste($id_grupo) == false) {
         return "Esse grupo não existe!";
      }

      //Verifica se o usuário logado é Moderador
      if($this->ehModerador($id_grupo, Auth::user()->id) == false) {
         return "Você não é Moderador!!";
      }

      if($this->esseUsuarioExiste($id_user) == false) {
         return "Usuário inexistente!";
      }

      //Se a solicitação existir
      if($this->essaSolicitacaoExiste($id_grupo, $id_user) == false) {
         return "Essa solicitação não existe mais";
      }

      //Verifica se aquele cara é membro do grupo
      if($this->ehMembroDoGrupo($id_grupo, $id_user) == true) {
         $grupo = \site\Grupo::find($id_grupo);
         $grupo->getSolicitacoes()->detach($id_user);
         return "Mas esse cara já é membro";
      }


      $grupo = \site\Grupo::find($id_grupo);
      $grupo->getSolicitacoes()->detach($id_user);
      return redirect()->back()->withErros(array('msg' => "asdasdasd"));
   }

   public function sairDoGrupo($id_grupo) {

      //Se o grupo existir
      if($this->esseGrupoExiste($id_grupo) == false) {
         return "Esse grupo não existe!";
      }

      //Verifica se o cara logado é membro do grupo
      if($this->ehMembroDoGrupo($id_grupo, Auth::user()->id) == false) {
         return "Você não é membro desse Grupo!";
      }

      $grupo = \site\Grupo::find($id_grupo);
      if ($grupo->getMembros->count() == 1) {
         $this->apagarGrupo($id_grupo);
         $grupo->delete();
         return redirect('/grupos');
      }

      //Verifica se o usuário logado é Moderador
      if($this->ehModerador($id_grupo, Auth::user()->id) == true) {
         if($this->quantidadeDeModeradores($id_grupo) == 1) {
            return "Você é o unico Moderador! Um grupo não pode ficar sem moderador!";
         }
      }

      $grupo->getMembros()->detach(Auth::user()->id);

      if ($grupo->getModeradores->contains(Auth::user()->id)) {
         $grupo->getModeradores()->detach(Auth::user()->id);
      }
      return redirect('/grupos');
   }

   public function removerDoGrupo($id_grupo, $id_user) {

      //Se o grupo existir
      if($this->esseGrupoExiste($id_grupo) == false) {
         return "Esse grupo não existe!";
      }

      $grupo = \site\Grupo::find($id_grupo);
      if ($grupo->getMembros->count() == 1) {
         $this->apagarGrupo($id_grupo);
         $grupo->delete();
         return redirect('/grupos');
      }

      //Verifica se o usuário logado é Moderador
      if($this->ehModerador($id_grupo, Auth::user()->id) == false) {
         return "Você não é Moderador!!";
      }

      //Se tiver outros membros e o único moderador tentar se remover
      if($id_user == Auth::user()->id && $this->quantidadeDeModeradores($id_grupo) == 1) {
         return "Esse grupo só tem você como moderador. Um grupo não pode ficar sem moderador!";
      }

      //Verifica se aquele cara é membro do grupo
      if($this->ehMembroDoGrupo($id_grupo, $id_user) == false) {
         return "Esse cara ai não é membro do grupo não! ~.~";
      }

      $grupo = \site\Grupo::find($id_grupo);
      $grupo->getMembros()->detach($id_user);

      if ($grupo->getModeradores->contains($id_user)) {
         $grupo->getModeradores()->detach($id_user);
      }
      return redirect("/grupos");
   }

   public function verGrupo($id_grupo) { //[???????- Onde isso é usado? -????????]

      //Se o grupo existir
      if($this->esseGrupoExiste($id_grupo) == false) {
         return "Esse grupo não existe!";
      }

      //Verifica se o cara logado é membro do grupo
      if($this->ehMembroDoGrupo($id_grupo, Auth::user()->id) == false) {
         return "Você não é membro desse Grupo!";
      }

      $grupo = \site\Grupo::find($id_grupo);
      // echo $grupo;
      return view('grupo/homeGrupo', [ 'grupo' => $grupo]);
   }

   public function novoPost($id_grupo) {

      //Se o grupo existir
      if($this->esseGrupoExiste($id_grupo) == false) {
         return "Esse grupo não existe!";
      }

      //Verifica se o cara logado é membro do grupo
      if($this->ehMembroDoGrupo($id_grupo, Auth::user()->id) == false) {
         return "Você não é membro desse Grupo!";
      }

      $grupo = \site\Grupo::find($id_grupo);
      return view('grupo/novoPost', ['grupo' => $grupo]);
   }

   public function salvar_novoPost(Request $req) {
      //valide essa resquest
      $req->validate(\site\Post::getRules(), \site\Post::getMsgs());


      //Se o grupo existir
      if($this->esseGrupoExiste($req->id_grupo) == false) {
         return "Esse grupo não existe!";
      }

      //Verifica se o cara logado é membro do grupo
      if($this->ehMembroDoGrupo($req->id_grupo, Auth::user()->id) == false) {
         return "Você não é membro desse Grupo!";
      }

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

   public function deletarPost($id_grupo, $id_post) {

      if (!$this->esseGrupoExiste($id_grupo)) {
         return 'Esse grupo nem existe';
      }


      $grupo = \site\Grupo::find($id_grupo);
      if ($grupo) {
         if (!$grupo->getModeradores->contains(Auth::user()->id)) {
            return 'tu nem é moderador';
         }
         if ($grupo->getPosts->contains($id_post)) {
            $grupo->getPosts()->detach($id_post);
         }
      }
      return redirect()->back();
   }

   public function listarMembros($id_grupo) {

      //Se o grupo existir
      if($this->esseGrupoExiste($id_grupo) == false) {
         return "Esse grupo não existe!";
      }
      //Não precisa ser membro do grupo pra ver os Membros

      $grupo = \site\Grupo::find($id_grupo);
      $amigos = $grupo->getMembros;
      return view('grupo/listarMembros', ['listaAmigos' => $amigos, 'grupo' => $grupo]);
   }

   public function listarModeradores($id_grupo) {

      //Se o grupo existir
      if($this->esseGrupoExiste($id_grupo) == false) {
         return "Esse grupo não existe!";
      }

      //Verifica se o cara logado é membro do grupo
      if($this->ehMembroDoGrupo($id_grupo, Auth::user()->id) == false) {
         return "Você não é membro desse Grupo!";
      }

      $grupo = \site\Grupo::find($id_grupo);
      $moderadores = $grupo->getModeradores;
      return view('grupo/listarModeradores', ['listaAmigos' => $moderadores]);
   }

   public function listarPerfisExternos($id_grupo) {

      //Se o grupo existir
      if($this->esseGrupoExiste($id_grupo) == false) {
         return "Esse grupo não existe!";
      }

      //Verifica se o cara logado é membro do grupo
      if($this->ehMembroDoGrupo($id_grupo, Auth::user()->id) == false) {
         return "Você não é membro desse Grupo!";
      }

      $grupo = \site\Grupo::find($id_grupo);
      $perfis = $grupo->getPerfisExterno;
      return view('grupo/listarPerfilExterno', ['grupo' => $grupo, 'perfisExterno' => $perfis]);
   }

   public function novoPerfilExterno($id_grupo) {

      //Se o grupo existir
      if($this->esseGrupoExiste($id_grupo) == false) {
         return "Esse grupo não existe!";
      }

      //Verifica se o usuário logado é Moderador
      if($this->ehModerador($id_grupo, Auth::user()->id) == false) {
         return "Você não é Moderador!!";
      }

      $grupo = \site\Grupo::find($id_grupo);
      return view('grupo/novoPerfilExterno', ['grupo' => $grupo]);
   }

   public function salvar_novoPerfilExterno(Request $req) {
      //validar request
      $req->validate(\site\PerfilExternoGrupo::getRules(), \site\PerfilExternoGrupo::getMsgs());


      //Se o grupo existir
      if($this->esseGrupoExiste($req->id_grupo) == false) {
         return "Esse grupo não existe!";
      }

      //Verifica se o usuário logado é Moderador
      if($this->ehModerador($req->id_grupo, Auth::user()->id) == false) {
         return "Você não é Moderador!!";
      }

      $perfil = new \site\PerfilExternoGrupo();
      $perfil->nome = $req->nome;
      $perfil->link = $req->link;
      $perfil->grupo_id = $req->id_grupo;
      $perfil->save();
      return redirect('/grupos/ver/'.$req->id_grupo);
   }

   public function apagarPerfilExterno($id_perfil, $id_grupo) {

      //Se o grupo existir
      if($this->esseGrupoExiste($id_grupo) == false) {
         return "Esse grupo não existe!";
      }

      //Verifica se o usuário logado é Moderador
      if($this->ehModerador($id_grupo, Auth::user()->id) == false) {
         return "Você não é Moderador!!";
      }

      $perfil = \site\PerfilExternoGrupo::find($id_perfil);

      if ($perfil) {
         $perfil->delete();
      }

      return redirect()->back();
   }

   public function editarPerfilExterno($id_perfil, $id_grupo) {

      //Se o grupo existir
      if($this->esseGrupoExiste($id_grupo) == false) {
         return "Esse grupo não existe!";
      }

      //Verifica se o usuário logado é Moderador
      if($this->ehModerador($id_grupo, Auth::user()->id) == false) {
         return "Você não é Moderador!!";
      }

      $grupo = \site\Grupo::find($id_grupo);
      $perfil = \site\PerfilExternoGrupo::find($id_perfil);

      return view('grupo/editarPerfilExterno', ['grupo' => $grupo, 'perfil_externo' => $perfil]);
   }

   public function salvar_editarPerfilExterno(Request $req) {
      //valida a request
      $req->validate(\site\PerfilExternoGrupo::getRules(), \site\PerfilExternoGrupo::getMsgs());


      //Se o grupo existir
      if($this->esseGrupoExiste($req->id_grupo) == false) {
         return "Esse grupo não existe!";
      }

      //Verifica se o usuário logado é Moderador
      if($this->ehModerador($req->id_grupo, Auth::user()->id) == false) {
         return "Você não é Moderador!!";
      }

      $perfil = \site\PerfilExternoGrupo::find($req->id);
      $perfil->nome = $req->nome;
      $perfil->link = $req->link;
      $perfil->save();
      return redirect('grupos/ver/' . $req->id_grupo);
   }

   public function listarCuradorias($id_grupo) {

      //Se o grupo existir
      if($this->esseGrupoExiste($id_grupo) == false) {
         return "Esse grupo não existe!";
      }

      //Verifica se o cara logado é membro do grupo
      if($this->ehMembroDoGrupo($id_grupo, Auth::user()->id) == false) {
         return "Você não é membro desse Grupo!";
      }

      $grupo = \site\Grupo::find($id_grupo);
      $curadorias = $grupo->getCuradorias;
      return view('grupo/listarCuradorias', ['grupo' => $grupo, 'curadorias' => $curadorias]);
   }

   public function novaCuradoria($id_grupo) {

      //Se o grupo existir
      if($this->esseGrupoExiste($id_grupo) == false) {
         return "Esse grupo não existe!";
      }

      //Verifica se o usuário logado é Moderador
      if($this->ehModerador($id_grupo, Auth::user()->id) == false) {
         return "Você não é Moderador!!";
      }

      $grupo = \site\Grupo::find($id_grupo);

      return view('grupo/novaCuradoria', ['grupo' => $grupo]);
   }

   public function salvar_novaCuradoria(Request $req) {
      //já sabe q tem q validar né sekva? é '-'

      $req->validate(\site\Curadoria_grupos::getRules(), \site\Curadoria_grupos::getMsgs());


      //Se o grupo existir
      if($this->esseGrupoExiste($req->id_grupo) == false) {
         return "Esse grupo não existe!";
      }

      //Verifica se o usuário logado é Moderador
      if($this->ehModerador($req->id_grupo, Auth::user()->id) == false) {
         return "Você não é Moderador!!";
      }

      $curadoria = new \site\Curadoria_grupos();
      $curadoria->nome = $req->nome;
      $curadoria->link = $req->link;
      $curadoria->descricao = $req->descricao;
      $curadoria->id_grupo = $req->id_grupo;
      $curadoria->save();

      return redirect('grupos/ver/' . $req->id_grupo);
   }

   public function apagarCuradoria($id_curadoria, $id_grupo) {

      //Se o grupo existir
      if($this->esseGrupoExiste($id_grupo) == false) {
         return "Esse grupo não existe!";
      }

      //Verifica se o usuário logado é Moderador
      if($this->ehModerador($id_grupo, Auth::user()->id) == false) {
         return "Você não é Moderador!!";
      }

      $curadoria = \site\Curadoria_grupos::find($id_curadoria);

      if ($curadoria) {
         $curadoria->delete();
      }

      return redirect()->back();
   }

   public function editarCuradoria($id_curadoria, $id_grupo) {

      //Se o grupo existir
      if($this->esseGrupoExiste($id_grupo) == false) {
         return "Esse grupo não existe!";
      }

      //Verifica se o usuário logado é Moderador
      if($this->ehModerador($id_grupo, Auth::user()->id) == false) {
         return "Você não é Moderador!!";
      }

      $grupo = \site\Grupo::find($id_grupo);
      $curadoria = \site\Curadoria_grupos::find($id_curadoria); //

      return view('grupo/editarCuradoria', ['grupo' => $grupo, 'curadoria' => $curadoria]);
   }

   public function salvar_editarCuradoria(Request $req) {
      //valida a request
      $req->validate(\site\Curadoria_grupos::getRules(), \site\Curadoria_grupos::getMsgs());


      //Verifica se o usuário logado é Moderador
      if($this->ehModerador($req->id_grupo, Auth::user()->id) == false) {
         return "Você não é Moderador!!";
      }

      $curadoria = \site\Curadoria_grupos::find($req->id);
      $curadoria->nome = $req->nome;
      $curadoria->link = $req->link;
      $curadoria->descricao = $req->descricao;
      $curadoria->save();
      return redirect('grupos/ver/' . $req->id_grupo);
   }

   public function promoverParaModerador($id_grupo, $id_user) {

      //Se o grupo existir
      if($this->esseGrupoExiste($id_grupo) == false) {
         return "Esse grupo não existe!";
      }

      $grupo = \site\Grupo::find($id_grupo);
      $moderadores = $grupo->getModeradores;

      //Verifica se o usuário logado é Moderador
      if($this->ehModerador($id_grupo, Auth::user()->id) == false) {
         return "Você não é Moderador!!";
      }

      $membros = $grupo->getMembros;

      //Verifica se aquele cara é membro do grupo
      if($this->ehMembroDoGrupo($id_grupo, $id_user) == false) {
         return "Esse cara ai não é membro do grupo não! ~.~";
      }

      //Verifica se aquele cara já não é moderador
      if($this->ehModerador($id_grupo, $id_user) == true) {
         return ("Esse cara já é moderador!");
      }

      $grupo->getModeradores()->attach($id_user);

      return redirect()->back();
   }

   public function reduzirModerador($id_grupo, $id_user) {

      $grupo = \site\Grupo::find($id_grupo);
      $moderadores = $grupo->getModeradores;
      $membros = $grupo->getMembros;

      //Se o grupo existir
      if($this->esseGrupoExiste($id_grupo) == false) {
         return "Esse grupo não existe!";
      }

      //Verifica se o usuário logado é Moderador
      if($this->ehModerador($id_grupo, Auth::user()->id) == false) {
         return "Você não é Moderador!!";
      }

      //Verifica se aquele cara é membro do grupo
      if($this->ehMembroDoGrupo($id_grupo, $id_user) == false) {
         return "Esse cara ai não é membro do grupo não! ~.~";
      }

      //Verifica se aquele cara já não é moderador
      if($this->ehModerador($id_grupo, $id_user) == false) {
         return "Esse cara não é moderador!";
      }

      if($this->quantidadeDeModeradores($id_grupo) == 1) {
         return "Um grupo não pode ficar sem moderador!";
      }

      $grupo->getModeradores()->detach($id_user);
      return redirect()->back();
   }

}
