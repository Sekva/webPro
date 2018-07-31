@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
      <div class="btn">
        <a  href="/home/novaCuradoria" >Novo Curadoria!</a>
      </div>
        <div class="col-md-8">
          @foreach ($curadorias as $curadoria)

            <div class="card">
                <div class="card-header">Curadoria {{$curadoria->nome}}
                    <span style="float:right; margin-left:10px;">
                      <a href="/home/apagarCuradoria/{{$curadoria->id}}">Apagar!</a>
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
