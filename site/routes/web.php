<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/home/asd', 'HomeController@coisa');

Route::get('/home/perfilExterno', 'HomeController@perfilExterno');

Route::post('/home/salvar_perfilExterno', 'HomeController@salvar_perfilExterno');

Route::get('/home/mudarFotoPerfil', 'HomeController@mudarFotoPerfilView');

Route::post('/home/salvar_fotoPerfil', 'HomeController@salvar_fotoPerfil');

Route::get('/home/novoPost', 'PostController@novoPost');

Route::post('/home/salvar_novoPost', 'PostController@salvar_novoPost');

Route::get('/home/listarPosts', 'PostController@listarPosts');

Route::get('/home/deletarPost/{id}', 'PostController@deletarPost');

Route::get('/home/editarPost/{id}', 'PostController@editarPost');

Route::post('/home/salvar_editarPost', 'PostController@salvar_editarPost');

Route::get('/usuario/mostrarPerfil', 'UserController@mostrarPerfil');

Route::get('/usuario/{id}/editar', 'UserController@editar');

Route::post('/usuario/salvarEdicao', 'UserController@salvarEdicao');

Route::get('/usuario/{id}/checarDeletar', 'UserController@checarDeletar');

Route::get('/usuario/{id}/deletar', 'UserController@deletar');
