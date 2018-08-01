@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-8">
         @foreach($lista as $l)
         <div class="card">
            <div class="card-header">
               <span>
                  <h2>
                     {{$l->name}}
                  </h2>
               </span>
               <span style="float:right">
                  <a href="/amigos/ver/{{$l->id}}">xo v!</a>
                  <br>
                  <a href="/amigos/aceitarAmizade/{{$l->id}}">ACEITO SA PORRA!</a>
               </span>

               <span style="float:left">
                  <img src="{{$l->foto}}" width="50" height="50">
               </span>
            </div>
         </div>
         <hr>
         <hr>
         @endforeach
      </div>
   </div>
</div>
@endsection
