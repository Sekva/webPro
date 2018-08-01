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
            @foreach($perfisExterno as $p)
                @if($p->nome != null)
                    <hr>
                    <b>Nome do Perfil Externo:</b> {{$p->nome}}</br>
                    <b>Link do Perfil Externo:</b> {{$p->link}}</br>
                @else
                    <b>Nome do Perfil Externo:</b> {{'Perfil Externo incompleto ou não feito'}}</br>
                    <b>Link do Perfil Externo:</b> {{'Perfil Externo incompleto ou não feito'}}</br>
                @endif
            @endforeach
            <hr>
            <h3>Editar</h3>
            <a href="{{url("/usuario/$user->id/editar")}}">
                <button class="btn btn-primary" name="button">Dados do Perfil</button>
            </a>
            <a href="{{url("/usuario/$user->id/deletar")}}">
                <button class="btn btn-primary" name="button">Deletar</button>
            </a>
        </div>
      </div>
      <hr>
      <hr>
    </div>
  </div>
</div>

@endsection
