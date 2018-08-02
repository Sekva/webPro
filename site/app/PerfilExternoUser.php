<?php

namespace site;

use Illuminate\Database\Eloquent\Model;

class PerfilExternoUser extends Model {

   public static $rules = [
      'nome' => 'required|min:4',
      'link' => 'required',
   ];

   public static $messages = [
      'required' => 'O campo :attribute é obrigatório',
      'nome.min' => 'o nome tem que ter pelo menos 10 caracteres',
   ];

   public static function getRules() {
      return static::$rules;
   }

   public static function getMsgs() {
      return static::$messages;
   }

   public function getUser() {
    return $this->belongsTo('site\User', 'user_id');
   }
}
