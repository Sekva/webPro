<?php

namespace site;

use Illuminate\Database\Eloquent\Model;

class PerfilExternoGrupo extends Model {
   public static $rules = [
      'nome' => 'required|min:4',
      'link' => 'required',
   ];

   public static $messages = [
      'required' => 'O campo :attribute é obrigatório',
      'nome.min' => 'o nome tem que ter pelo menos 4 caracteres',
   ];

   public static function getRules() {
      return static::$rules;
   }

   public static function getMsgs() {
      return static::$messages;
   }
}
