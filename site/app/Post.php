<?php

namespace site;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Post extends Model {

   public static $rules = [
      'texto' => 'required|min:4',
      'conteudo' => 'required|min:5',
   ];

   public static $messages = [
      'required' => 'O campo :attribute é obrigatório',
      'texto.min' => 'O titulo deve ter pelo menos 4 chars',
      'conteudo.min' => 'O conteudo deve ter pelo menos 5 chars',
   ];

   public static function getRules() {
      return static::$rules;
   }

   public static function getMsgs() {
      return static::$messages;
   }

    public function users() {
        return $this->belongsTo('site\User', 'id_autor');
    }

    public function comentario() {
      return $this0>hasMany('App\Post');
   }

    public function getComentarios() {
      return DB::table('comentarios')->where('id_post', $this->id)->get();
   }


}
