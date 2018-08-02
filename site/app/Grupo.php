<?php

namespace site;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model {

   public static $rules = [
      'name' => 'required|min:5',
      'descricao' => 'required|min:10',
   ];

   public static $messages = [
      'required' => 'O campo :attribute é obrigatório',
      'name.min' => 'Um nome de 5 caracteres',
      'descricao.min' => 'A descricao tem que ter pelo menos 10 caracteres',
   ];

   public static function getRules() {
      return static::$rules;
   }

   public static function getMsgs() {
      return static::$messages;
   }


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
