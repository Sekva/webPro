@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
      <div class="btn">
         @if($grupo->getModeradores->contains(Auth::user()->id))
            <a  href="/grupos/novaCuradoria/{{$grupo->id}}" >Nova Curadoria!</a>
         @endif
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
                <div class="card-header">Curadorias

                   @if($grupo->getModeradores->contains(Auth::user()->id))
                    <span style="float:right; margin-left:10px;">
                      <a href="/grupos/apagarCuradoria/{{$curadoria->id}}/{{$grupo->id}}" onclick="return confirm('Certeza que quer apagar esta curadoria?')">Apagar!</a>
                    </span>
                    <span style="float:right; margin-left:10px;">
                      <a href="/grupos/editarCuradoria/{{$curadoria->id}}/{{$grupo->id}}">Editar!</a>
                    </span>
                    @endif

                </div>
                <div class="card-body">

                  <span>Nome:</span> <span> {{$curadoria->nome}} </span>
                  <br>
                  <span>Link:</span> <span> {{$curadoria->link}} </span>
                  <br>
                  <br>
                  <p> {{$curadoria->descricao}} </p>

                </div>
            </div>
            <hr><hr>
            @endforeach
        </div>
    </div>
</div>


@endsection
