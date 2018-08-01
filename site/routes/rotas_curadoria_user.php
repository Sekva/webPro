<?php

Route::get('/home/curadorias', 'CuradoriaUserController@listarCuradorias');

Route::get('/home/novaCuradoria', 'CuradoriaUserController@novaCuradoria');

Route::post('/home/salvarNovaCuradoria', 'CuradoriaUserController@salvarNovaCuradoria');

Route::get('/home/editarCuradoria/{id}', 'CuradoriaUserController@editarCuradoria');

Route::post('/home/salvarEditCuradoria', 'CuradoriaUserController@salvarEditCuradoria');

Route::get('/home/apagarCuradoria/{id}', 'CuradoriaUserController@apagarCuradoria');
