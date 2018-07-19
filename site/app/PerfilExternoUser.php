<?php

namespace site;

use Illuminate\Database\Eloquent\Model;

class PerfilExternoUser extends Model
{
  public function getUser() {
    return $this->belongsTo('site\User', 'user_id');
  }
}
