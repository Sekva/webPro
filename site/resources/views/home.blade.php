@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

      <div>
        <a href="{{url("/usuario/mostrarPerfil")}}">Ver meu Perfil!</a><br>

        <a href="/home/novoPost">Novo Post</a>
        <a href="/home/mudarFotoPerfil"><img src="{{ Auth::user()->foto }}" width="80" height="80"></a>
        <a href="/home/listarPosts">Listar Post</a>
        <a href="/grupos">Grupos</a>
        <br>
        <a href="/amigos">Amigos</a>
      </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
