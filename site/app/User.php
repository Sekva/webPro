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

<<<<<<< HEAD
    public function getPerfilExterno($id_user) {
      return DB::table('perfis_externos')->where('id', $id_user)->first();
    }

    public function getPosts($id_autor) {
      return DB::table('posts')->where('id_autor', $id_autor)->orderBy('created_at', 'desc')->get();
    }

    public function getUnicoPost($id_autor, $id_post) {
      return DB::table('posts')->where('id_autor', $id_autor)->where('id', $id_post)->first();
    }

    public function perfil() {
      return $this->hasOne('site\Perfis_externos', 'id');
    }

=======
    public function perfil() {
            return $this->hasOne('site\Perfis_externos', 'id');
    }

>>>>>>> fda1292cb48483cfeb38444cd451d293316f58ce
}
