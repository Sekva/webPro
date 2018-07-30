@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
      <div class="btn">
        <a  href="/home/novoPerfilExterno" >Novo Perfil!</a>
      </div>
        <div class="col-md-8">
          @foreach ($perfisExterno as $perfilExterno)

            <div class="card">
                <div class="card-header">Perfil Externo
                    <span style="float:right; margin-left:10px;">
                      <a href="/home/apagarPerfilExterno/{{$perfilExterno->id}}">Apagar!</a>
                    </span>
                    <span style="float:right; margin-left:10px;">
                      <a href="/home/editarPerfilExterno/{{$perfilExterno->id}}">Editar!</a>
                    </span>
                </div>
                <div class="card-body">

                  <span>Nome:</span> <span> {{$perfilExterno->nome}} </span>
                  <br>
                  <span>Link:</span> <span> {{$perfilExterno->link}} </span>

                </div>
            </div>
            <hr><hr>
            @endforeach
        </div>
    </div>
</div>


@endsection
