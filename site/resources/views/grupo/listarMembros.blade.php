@extends('layouts.app')

@section('content')


  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-8">
             @foreach($listaAmigos as $amigo)
              <div class="card">

                  <div class="card-header">
                    <span>
                       {{$amigo->name}}
                    </span>
                    <span style="float:right">
                      <a href="/amigos/ver/{{$amigo->id}}">xo v!</a>
                    </span>

                    @if($grupo->getModeradores->contains(Auth::user()->id))
                        @if($grupo->getModeradores->contains($amigo->id))
                          <br>
                          <span style="float:right">
                            <a href="/grupo/reduzirModerador/{{$grupo->id}}/{{$amigo->id}}">REBAIXAR</a>
                          </span>
                        @else
                          <br>
                          <span style="float:right">
                            <a href="/grupo/promoverParaModerador/{{$grupo->id}}/{{$amigo->id}}">SUBIR DE VIDA</a>
                          </span>
                        @endif
                    @endif

                  </div>

                  <div class="card-body">
                     <span style="float:left">
                        <img src="{{$amigo->foto}}" width="50" height="50">
                     </span>

                     {{$amigo->descricao}}

                  </div>
              </div>
              <hr>
              <hr>
              @endforeach
          </div>
      </div>
  </div>



@endsection
