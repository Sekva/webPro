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
                      <a href="/amigos/ver/{{$amigo->id}}">Ver</a>
                    </span>
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
