<?php

namespace site;

use Illuminate\Database\Eloquent\Model;

class Perfis_externos extends Model{

    public function user() {
        return $this->belongsTo('site\User', 'id');
    }

}
