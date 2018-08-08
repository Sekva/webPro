@extends('layouts.app')

@section('content')

<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-8">
         <div class="card">

            <div class="card-header"><h2>Seu Perfil</h2></div>

            <div class="card-body">
               <input type="hidden" name="id" value="{{$user->id}}" />
               <b>Nome:</b> {{$user->name}}</br>
               <b>E-mail:</b> {{$user->email}}</br>
               <b>Descrição:</b> {{$user->descricao}}</br>
               @if(!$perfisExternos->isEmpty())
                  <hr>
                  <h2>Perfis Externos</h2>
                  @foreach($perfisExternos as $p)
                     <b>Nome do Perfil Externo:</b> {{$p->nome}}</br>
                     <b>Link do Perfil Externo:</b> {{$p->link}}</br>
                  @endforeach
               @endif
               @if(!$curadorias->isEmpty())
                  <hr>
                  <h2>Curadorias</h2>
                  @foreach($curadorias as $c)
                     <b>Nome da Curadoria:</b> {{$c->nome}}</br>
                     <b>Descrição da Curadoria:</b> {{$c->descricao}}</br>
                     <b>Link da Curadoria:</b> {{$c->link}}</br>
                  @endforeach
               @endif
               <hr>
               <h3>Editar</h3>
               <a href="{{url("/usuario/$user->id/editar")}}">
                  <button class="btn btn-primary" name="button">Dados do Perfil</button>
               </a>
               <a href="{{url("/usuario/$user->id/deletar")}}">
                  <button class="btn btn-primary" name="button" onclick="return confirm('Certeza que quer se apagar?\nNão tem volta ein...')" >Deletar</button>
               </a>
            </div>
         </div>
         <hr>
         <hr>
      </div>
   </div>
</div>

@endsection
