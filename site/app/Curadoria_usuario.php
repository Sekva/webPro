<?php

namespace site;

use Illuminate\Database\Eloquent\Model;

class Curadoria_usuario extends Model
{
  public function getUser() {
    return $this->belongsTo('site\User', 'id_user');
  }
}
