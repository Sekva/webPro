<?php


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/home/erro', 'HomeController@msgErro');

Route::middleware('auth')->group(function () {

   Route::get('/home/mudarFotoPerfil', 'HomeController@mudarFotoPerfilView');

   Route::post('/home/salvar_fotoPerfil', 'HomeController@salvar_fotoPerfil');


});

include dirname(__FILE__)."/rotas_curadoria_user.php";
include dirname(__FILE__)."/rotas_users.php";
include dirname(__FILE__)."/rotas_perfil_externo_user.php";
include dirname(__FILE__)."/rotas_posts.php";
include dirname(__FILE__)."/rotas_comentarios.php";
include dirname(__FILE__)."/rotas_amigos.php";
include dirname(__FILE__)."/rotas_grupos.php";
