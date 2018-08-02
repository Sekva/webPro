<?php


Route::get('/grupos', 'GrupoController@listarGrupos');

Route::get('/grupos/novoGrupo', 'GrupoController@novoGrupo');

Route::post('/grupos/salvar_novoGrupo', 'GrupoController@salvar_novoGrupo');

Route::get('/grupos/listarTodosGrupos', 'GrupoController@listarTodosGrupos');

Route::get('/grupos/solicitarEntradaEmGrupo/{id}', 'GrupoController@solicitarEntradaEmGrupo');

Route::get('/grupos/aceitarSolicitacao/{id_user}/{id_grupo}', 'GrupoController@aceitarSolicitacao');

Route::get('/grupos/sairDoGrupo/{id}', 'GrupoController@sairDoGrupo');

Route::get('/grupos/removerDoGrupo/{id_grupo}/{id_user}', 'GrupoController@removerDoGrupo');
