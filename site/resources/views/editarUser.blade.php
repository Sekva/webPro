<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
            <title>Editar Usuário</title>

    </head>
    <body>
    	<h1>Editar Usuário</h1>

    	<form action="/salvarUser" method="post">
    		<input type="hidden" name="_token" value="{{ csrf_token() }}" />
    			<input type="hidden" name="id" value="{{ $user->id}}" />
    			Nome: <input type="text" name="nome" value="{{$user->nome}}"><br/>
    			E-mail: <input type="text" name="email" value="{{$user->email}}"><br/>
    			Senha: <br/> <p>link pra mudar senha</p>
                Foto: <input type="text" name="foto" value="{{$user->foto}}"><br/>

                Nome do Perfil Externo: <input type="text" name="nome_perfil_externo" value="{{$user->nome}}"><br/>
                Link do Perfil Externo: <input type="text" name="link_perfil_externo" value="{{$user->nome}}"><br/>
    			<input  type="submit" value="alterar" />
    	</form>

    </body>
</html>
