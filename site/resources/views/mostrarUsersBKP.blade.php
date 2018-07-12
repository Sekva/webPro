<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
            <title>Editar Usuário</title>

    </head>
    <body>
    	<h1>Editar Uzuáhriu</h1>

    	<form action="/editarProduto" method="get">
    		<input type="hidden" name="_token" value="{{ csrf_token() }}" />
                @foreach ($users as $user)
                    <input type="hidden" name="id" value="{{ $user->id}}" />
        			Nome: <input type="text" name="name" value="{{$user->name}}"><br/>
        			E-mail: <input type="text" name="email" value="{{$user->email}}"><br/>
        			Senha: link pra mudar senha </br>
                    Foto: <input type="text" name="foto" value="{{$user->foto}}"><br/>
                    <!-- Descrição: <input type="text" name="descricao" value="{{$user->descricao}}"></br> -->
                    Descrição: {{$user->descricao}}</br>


                    Nome do Perfil Externo: <input type="text" name="nome_perfil_externo" value="{{$user->perfil['nome']}}"></br>
                    Link do Perfil Externo: <input type="text" name="link_perfil_externo" value="{{$user->perfil['link']}}"></br>

                    <input  type="submit" value="alterar" /></br></br>
                @endforeach
    	</form>

    </body>
</html>
