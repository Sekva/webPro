<?php


Route::get('/grupos', 'GrupoController@listarGrupos');

Route::get('/grupos/novoGrupo', 'GrupoController@novoGrupo');

Route::post('/grupos/salvar_novoGrupo', 'GrupoController@salvar_novoGrupo');

Route::get('/grupos/listarTodosGrupos', 'GrupoController@listarTodosGrupos');

Route::get('/grupos/solicitarEntradaEmGrupo/{id}', 'GrupoController@solicitarEntradaEmGrupo');

Route::get('/grupos/cancelarSolicitacaoDeGrupo/{id}', 'GrupoController@cancelarSolicitacaoDeGrupo');

Route::get('/grupos/aceitarSolicitacao/{id_user}/{id_grupo}', 'GrupoController@aceitarSolicitacao');

Route::get('/grupos/recusarSolicitacao/{id_user}/{id_grupo}', 'GrupoController@recusarSolicitacao');

Route::get('/grupos/sairDoGrupo/{id}', 'GrupoController@sairDoGrupo');

Route::get('/grupos/removerDoGrupo/{id_grupo}/{id_user}', 'GrupoController@removerDoGrupo');

Route::get('/grupos/ver/{id}', 'GrupoController@verGrupo');

Route::get('/grupos/novoPost/{id}', 'GrupoController@novoPost');

Route::post('/grupos/salvar_novoPost', 'GrupoController@salvar_novoPost');

Route::get('/grupos/deletarPost/{id_grupo}/{id_post}', 'GrupoController@deletarPost');

Route::get('/grupos/listarMembros/{id}', 'GrupoController@listarMembros');

Route::get('/grupos/listarModeradores/{id}', 'GrupoController@listarModeradores');

Route::get('/grupos/listarPerfisExternos/{id}', 'GrupoController@listarPerfisExternos');

Route::get('/grupos/novoPerfilExterno/{id}', 'GrupoController@novoPerfilExterno');

Route::post('/grupos/salvar_novoPerfilExterno', 'GrupoController@salvar_novoPerfilExterno');

Route::get('/grupos/apagarPerfilExterno/{id_perfil}/{id_grupo}', 'GrupoController@apagarPerfilExterno');

Route::get('/grupos/editarPerfilExterno/{id_perfil}/{id_grupo}', 'GrupoController@editarPerfilExterno');

Route::post('/grupos/salvar_editarPerfilExterno', 'GrupoController@salvar_editarPerfilExterno');

Route::get('/grupos/listarCuradorias/{id}', 'GrupoController@listarCuradorias');

Route::get('/grupos/novaCuradoria/{id}', 'GrupoController@novaCuradoria');

Route::post('/grupos/salvar_novaCuradoria', 'GrupoController@salvar_novaCuradoria');

Route::get('/grupos/apagarCuradoria/{id_curadoria}/{id_grupo}', 'GrupoController@apagarCuradoria');

Route::get('/grupos/editarCuradoria/{id_curadoria}/{id_grupo}', 'GrupoController@editarCuradoria');

Route::post('/grupos/salvar_editarCuradoria', 'GrupoController@salvar_editarCuradoria');

Route::get('/grupos/listarSolicitacoes/{id}','GrupoController@listarSolicitacoes' );

Route::get('/grupos/promoverParaModerador/{id_grupo}/{id_user}', 'GrupoController@promoverParaModerador');

Route::get('/grupos/reduzirModerador/{id_grupo}/{id_user}', 'GrupoController@reduzirModerador');
