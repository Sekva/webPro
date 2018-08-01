<?php


Route::get('/home/perfilExterno', 'PerfilExternoController@perfilExterno');

Route::get('/home/novoPerfilExterno', 'PerfilExternoController@novoPerfilExterno');

Route::get('/home/editarPerfilExterno/{id}', 'PerfilExternoController@editarPerfilExterno');

Route::post('/home/salvar_perfilExternoEdit', 'PerfilExternoController@salvar_perfilExternoEdit');

Route::get('/home/apagarPerfilExterno/{id}', 'PerfilExternoController@apagarPerfilExterno');

Route::post('/home/salvar_perfilExterno', 'PerfilExternoController@salvar_perfilExterno');
