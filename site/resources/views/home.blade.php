@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">

      <div>
         <div style="margin-right:50px">
            <a href="/home/mudarFotoPerfil"><img src="{{ Auth::user()->foto }}" width="80" height="80"></a>
         </div>
         <br>
         <a href="{{url("/usuario/mostrarPerfil")}}">Ver meu Perfil!</a>
         <br>
         <a href="/home/novoPost">Novo Post</a>
         <br>
         <a href="/home/listarPosts">Listar Post</a>
         <br>
         <a href="/grupos">Grupos</a>
         <br>
         <a href="/amigos">Amigos</a>
      </div>

      <div class="col-md-8">
         <div class="card">
            <div class="card-header">Seu Feed de todo dia</div>

            <div class="card-body">
               @if (session('status'))
               <div class="alert alert-success" role="alert">
                  {{ session('status') }}
               </div>
               @endif
               Opa!
               <br><br>

               <div class="card">
                  <div class="card-header">Seu Feed de todo dia</div>
                  <div class="card-body">
                     Opa!
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
