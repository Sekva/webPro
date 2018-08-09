@extends('layouts.app')
@section('content')

  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-8">
             <a href="/grupos/novoGrupo">Novo grupo!!!</a>
             <br>
             <a href="/grupos/listarTodosGrupos">Xo v tudo</a>
             <br>
             @foreach($grupos as $grupo)
              <div class="card">

                  <div class="card-header">
                     <h2>{{$grupo->name}}</h2>
                     <a href="/grupos/ver/{{$grupo->id}}">Ver</a>
                     <br>
                     <a href="/grupos/sairDoGrupo/{{$grupo->id}}" onclick="return confirm('Certeza que quer sair do grupo?')">Sair</a>
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
