<?php

namespace site;

use Illuminate\Database\Eloquent\Model;

class Curadoria_grupos extends Model {

   public static $rules = [
      'nome' => 'required|min:4',
      'descricao' => 'required|min:10',
      'link' => 'required',
   ];

   public static $messages = [
      'required' => 'O campo :attribute é obrigatório',
      'descricao.min' => 'A descricao tem que ter pelo menos 10 caracteres',
   ];

   public static function getRules() {
      return static::$rules;
   }

   public static function getMsgs() {
      return static::$messages;
   }

}
