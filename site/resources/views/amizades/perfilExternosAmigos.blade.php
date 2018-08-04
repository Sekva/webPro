@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-8">
         <div class="card">
            <div class="card-header">
               <h2>{{$amigo->name}}</h2>
               <span>Perfis externos</span>
            </div>
            <div class="card-body">
               @foreach($perfis as $perfil)
               <span>Nome: </span>
               <span>{{$perfil->nome}}</span>
               <br>
               <span>Link: </span>
               <span> <a href="//{{$perfil->link}}">{{$perfil->link}}</a> </span>
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
