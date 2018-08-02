<?php

namespace site;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Post extends Model {

    public function users() {
        return $this->belongsTo('App\User');
    }

    public function comentario() {
      return $this0>hasMany('App\Post');
   }

    public function getComentarios() {
      return DB::table('comentarios')->where('id_post', $this->id)->get();
   }


}
