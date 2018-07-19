<?php

namespace site;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'foto', 'descricao'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function getPosts($id_autor) {
      return DB::table('posts')->where('id_autor', $id_autor)->orderBy('created_at', 'desc')->get();
    }

    public function getUnicoPost($id_autor, $id_post) {
      return DB::table('posts')->where('id_autor', $id_autor)->where('id', $id_post)->first();
    }
    //
    // //Tá funcionando! \o/
    // public function perfil() {
    //     return $this->belongsTo('site\Perfis_externos', 'id_perfil_externo');
    // }


    public function getPerfisExternos() {
      return $this->hasMany('site\PerfilExternoUser', 'user_id');
    }

  }
