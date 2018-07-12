<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <title>Editar Usuário</title>
    </head>
    <body>
    	<h1>Editar Usuário</h1>
        <form action="/usuario/salvarEdicao" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{csrf_token()}}" />
            <input type="hidden" name="id" value="{{$user->id}}" />

    		Nome: <input type="text" name="name" value="{{$user->name}}"><br/>
    		E-mail: <input type="text" name="email" value="{{$user->email}}"><br/>
    		Nova Senha: <input type="password" name="password" value="{{$user->senha}}"><br/>
            Descrição: <input type="text" name="descricao" value="{{$user->descricao}}"></br>
            Foto: <input type="text" name="foto" value="{{$user->foto}}"><br/>

            @if($user->perfil != null)
                Nome do Perfil Externo: <input type="text" name="nome_perfil_externo" value="{{$user->perfil->nome}}"><br/>
                Link do Perfil Externo: <input type="text" name="link_perfil_externo" value="{{$user->perfil->link}}"><br/>
            @else
                Nome do Perfil Externo: <input type="text" name="nome_perfil_externo" value="Vazio /o\"><br/>
                Link do Perfil Externo: <input type="text" name="link_perfil_externo" value="Vazio /o\"><br/>
            @endif
            -Link editar Perfil Externo (uma coisa provisória, caso n dê tempo)-</br></br>

            <!-- <a href="/usuario/$user->id/salvarEdicao">Aplicar Edição!</a> -->
            <input  type="submit" value="Aplicar Mudança" />
        </form>
    </body>
</html>
