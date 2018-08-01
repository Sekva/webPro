<?php

namespace site;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use SoftDelets;

use Illuminate\Support\Facades\DB;

use Auth;

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

    //Para utilizar o SoftDelete
    // protected $dates = ['deleted_at'];

    public function posts() {
        return $this->hasMany('site\Post', 'id_autor');
    }

    public function comentario() {
        return $this->hasMany('site\Comentario', 'id_autor');
    }

    public function getPosts($id_autor) {
        return DB::table('posts')->where('id_autor', $id_autor)->orderBy('created_at', 'desc')->get();
    }

    public function getUnicoPost($id_autor, $id_post) {
        return DB::table('posts')->where('id_autor', $id_autor)->where('id', $id_post)->first();
    }

    public function getPerfisExternos() {
        return $this->hasMany('site\PerfilExternoUser', 'user_id');
    }

    public function getCuradorias() {
        return $this->hasMany('site\Curadoria_usuario', 'id_user');
    }

    function getAmigos() {
      return $this->belongsToMany('\site\User', 'amizades', 'id_user1', 'id_user2');
    }

    public function getSolicitacoes() {
      return $this->belongsToMany('\site\User', 'solicitacao_amizades', 'id_quem_recebeu', 'id_quem_pediu');
    }

    public function getPedidosAmizadeEnviados() {
      return $this->belongsToMany('\site\User', 'solicitacao_amizades', 'id_quem_pediu', 'id_quem_recebeu');
    }
  }
