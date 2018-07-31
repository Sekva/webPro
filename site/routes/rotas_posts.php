<?php


Route::get('/home/novoPost', 'PostController@novoPost');

Route::post('/home/salvar_novoPost', 'PostController@salvar_novoPost');

Route::get('/home/listarPosts', 'PostController@listarPosts');

Route::get('/home/deletarPost/{id}', 'PostController@deletarPost');

Route::get('/home/editarPost/{id}', 'PostController@editarPost');

Route::post('/home/salvar_editarPost', 'PostController@salvar_editarPost');
