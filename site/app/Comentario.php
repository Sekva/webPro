<?php

namespace site;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Comentario extends Model {

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
