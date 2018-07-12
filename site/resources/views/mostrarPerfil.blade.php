<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
            <title>Editar Usuário</title>

    </head>
    <body>
    	<h1>Seu Perfil</h1>
        @can('editarUser', $user)
            <input type="hidden" name="id" value="{{$user->id}}" />
            Nome: <b>{{$user->name}}</b></br>
            E-mail: {{$user->email}}</br>
            Senha: {{'*?*?*?*?*?*'}}</br>
            Descrição: {{$user->descricao}}</br>
            @if($user->perfil != null)
                Nome do Perfil Externo: {{$user->perfil->nome}}</br>
                Link do Perfil Externo: {{$user->perfil->link}}</br>
            @else
                Nome do Perfil Externo: {{'Perfil Externo incompleto ou não feito'}}</br>
                Link do Perfil Externo: {{'Perfil Externo incompleto ou não feito'}}</br>
            @endif
            <br>
            <a href="{{url("/usuario/$user->id/editar")}}">Editar!</a>
            <a href="{{url("/usuario/$user->id/deletar")}}">Deletar Perfil</a>
            <!-- <input  type="submit" value="Editar" /></br></br> -->
            <hr>
        @endcan

    </body>
</html>
