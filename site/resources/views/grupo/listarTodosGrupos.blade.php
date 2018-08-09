@extends('layouts.app')
@section('content')

  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-8">
             <a href="/grupos/novoGrupo">Novo grupo!!!</a>
             @foreach($grupos as $grupo)
              <div class="card">

                  <div class="card-header">
                     <h2>{{$grupo->name}}</h2>

                     @if($grupo->getMembros->contains($user->id))
                     <a href="/grupos/ver/{{$grupo->id}}">Ver</a>
                     @else
                        @if($grupo->getSolicitacoes->contains($user->id))
                           <a href="/grupos/cancelarSolicitacaoDeGrupo/{{$grupo->id}}" onclick="return confirm('Certeza?')">Cancelar Solicitação</a>
                        @else
                           <a href="/grupos/solicitarEntradaEmGrupo/{{$grupo->id}}">Solicitar entrada</a>
                        @endif
                     @endif

                   </div>

                  <div class="card-body">
                     {{$grupo->descricao}}
                  </div>

              </div>
              <hr>
              <hr>
              @endforeach
              <div class="col-md-4" style=" margin-right: auto; margin-left: auto;">
                 {{ $grupos->links() }}
              </div>
          </div>
      </div>
  </div>



@endsection
