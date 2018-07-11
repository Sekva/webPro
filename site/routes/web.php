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
