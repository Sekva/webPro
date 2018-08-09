@extends('layouts.app')

@section('content')


<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-8">
         <div class="card">


            <div style=" text-align: center; margin-top: 20%;">
               <h1>
                  @if(isset($msg))
                     {{$msg}}
                  @else
                     Nada a declarar!
                  @endif
               </h1>
            </div>

            <div>
               <a href="/home">Voltar!</a>
            </div>

         </div>
      </div>
   </div>
</div>

@endsection
