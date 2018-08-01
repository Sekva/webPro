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

                     @if($grupo->getMebros->contains($user->id))
                     <a href="#">xo v</a>
                     @else
                     <a href="/grupos/solicitarEntradaEmGrupo/{{$grupo->id}}">Xo entrar?</a>
                     @endif

                   </div>

                  <div class="card-body">
                     {{$grupo->descricao}}
                  </div>

              </div>
              <hr>
              <hr>
              @endforeach
          </div>
      </div>
  </div>



@endsection
