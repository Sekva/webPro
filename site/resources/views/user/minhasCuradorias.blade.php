@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
      <div class="btn">
        <a  href="/home/novaCuradoria" >Novo Curadoria!</a>
      </div>
        <div class="col-md-8">

           @if($curadorias->count() == 0)
           <div style=" text-align: center; margin-top: 20%;">
                <h1>
                   Parece que não há nada aqui
                </h1>
           </div>
          @endif

          @foreach ($curadorias as $curadoria)

            <div class="card">
                <div class="card-header">Curadoria {{$curadoria->nome}}
                    <span style="float:right; margin-left:10px;">
                      <a href="/home/apagarCuradoria/{{$curadoria->id}}" onclick="return confirm('Certeza que quer apagar esta curadoria?')" >Apagar!</a>
                    </span>
                    <span style="float:right; margin-left:10px;">
                      <a href="/home/editarCuradoria/{{$curadoria->id}}">Editar!</a>
                    </span>
                </div>
                <div class="card-body">

                  <span>Descrição:</span> <span> {{$curadoria->descricao}} </span>
                  <br>
                  <span>Link:</span> <span> {{$curadoria->link}} </span>

                </div>
            </div>
            <hr><hr>
            @endforeach
        </div>
    </div>
</div>


@endsection
