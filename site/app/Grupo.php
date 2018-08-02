<?php

namespace site;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model {
   public function getMebros() {
      return $this->belongsToMany('\site\User', 'users_grupos', 'id_grupo' , 'id_user')->withTimestamps();
   }

   public function getModeradores() {
      return $this->belongsToMany('\site\User', 'moderadores', 'id_grupo', 'id_user')->withTimestamps();
   }

   public function getSolicitacoes() {
      return $this->belongsToMany('\site\User', 'solicitacoes_grupo', 'id_grupo_solicitado', 'id_user_pedinte')->withTimestamps();
   }

   public function getPosts() {
      return $this->belongsToMany('\site\Post', 'posts_grupos', 'id_grupo', 'id_post');
   }

   public function getPerfisExterno() {
      return $this->hasMany('\site\PerfilExternoGrupo', 'grupo_id');
   }

   public function getCuradorias() {
      return $this->hasMany('\site\Curadoria_grupos', 'id_grupo');
   }

}
