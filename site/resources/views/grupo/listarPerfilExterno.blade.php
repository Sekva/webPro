@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
      <div class="btn">
         @if($grupo->getModeradores->contains(Auth::user()->id))
            <a  href="/grupos/novoPerfilExterno/{{$grupo->id}}" >Novo Perfil!</a>
         @endif
      </div>
        <div class="col-md-8">
          @foreach ($perfisExterno as $perfilExterno)

            <div class="card">
                <div class="card-header">Perfil Externo

                   @if($grupo->getModeradores->contains(Auth::user()->id))
                    <span style="float:right; margin-left:10px;">
                      <a href="/grupos/apagarPerfilExterno/{{$perfilExterno->id}}/{{$grupo->id}}">Apagar!</a>
                    </span>
                    <span style="float:right; margin-left:10px;">
                      <a href="/grupos/editarPerfilExterno/{{$perfilExterno->id}}/{{$grupo->id}}">Editar!</a>
                    </span>
                    @endif

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
