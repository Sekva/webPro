@extends('layouts.app')

@section('content')


  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-8">
             @if(Auth::user()->id == $id)
               <a href="/amigos/listarPedidosPraMim">Pedidos de amizade</a>
             @endif
             <br>
             <a href="/amigos/listarTodosUsers"> Listar todos usuarios (em breve uma ferramenta de busca) </a>

             @if($listaAmigos->count() == 0)
               <div style=" text-align: center; margin-top: 20%;">
                  <h1>
                     Parece que não há nada aqui
                  </h1>
               </div>
            @endif

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
