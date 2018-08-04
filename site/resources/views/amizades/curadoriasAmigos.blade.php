@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-8">
         <div class="card">
            <div class="card-header">
               <h2>{{$amigo->name}}</h2>
               <span>Curadorias</span>
            </div>
            <div class="card-body">
               @foreach($curadorias as $curadoria)
               <span>Nome: </span>
               <span>{{$curadoria->nome}}</span>
               <br>
               <br>
               <div>
                  <p>
                     {{$curadoria->descricao}}
                  </p>
               </div>
               <br>
               <span>Link: </span>
               <span> <a href="//{{$curadoria->link}}">{{$curadoria->link}}</a> </span>
               <hr>
               @endforeach
            </div>
         </div>
         <hr>
         <hr>
      </div>
   </div>
</div>
@endsection
