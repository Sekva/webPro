<?php

namespace site;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Comentario extends Model {

   public static $rules = [
      'conteudo' => 'required|min:2',
      'avaliacao' => 'nullable',
   ];

   public static $messages = [
    	'required' => 'O :attribute é obrigatório',
    	'conteudo.min' => 'O conteudo deve ter ao menos 2 letras',
   ];

   public static function getRules() {
      return static::$rules;
   }

   public static function getMsgs() {
      return static::$messages;
   }

   public function users() {
      return $this->belongsTo('App\User');
   }

   public function post() {
      return $this->belongsTo('App\Post');
   }

   public function getAutor() {
      return DB::table('users')->where('id', $this->id_autor)->first();
   }
}
