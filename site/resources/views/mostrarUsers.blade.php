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
                    <input type="hidden" name="id" value="{{$user->id}}" />
                    {{$user->post}}
                    Nome: <b>{{$user->name}}</b></br>
                    E-mail: {{$user->email}}</br>
                    Senha: {{'*?*?*?*?*?*'}}</br>
                    Descrição: {{$user->descricao}}</br>
                    @if($user->perfil != null)
                        Nome do Perfil Externo: {{$user->perfil->nome}}</br>
                        Link do Perfil Externo: {{$user->perfil->link}}</br>
                    @else
                        <!-- {{$user->perfil}}<br> -->
                        Nome do Perfil Externo: {{'Perfil Externo incompleto ou não feito'}}</br>
                        Link do Perfil Externo: {{'Perfil Externo incompleto ou não feito'}}</br>
                    @endif
                    <br>
                    <input  type="submit" value="alterar" /></br></br>
                    <hr>
                @endforeach
    	</form>

    </body>
</html>
