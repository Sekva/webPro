@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">

      <div>
         <div style="margin-right:50px">
            <a href="#"><img src="/{{ $grupo->foto }}" width="80" height="80"></a>
         </div>
         <br>
         <a href="/grupos/novoPost/{{$grupo->id}}">Novo Post</a>
         <br>
         <a href="/grupos/listarMembros/{{$grupo->id}}">Mebros</a>
         <br>
         <a href="/grupos/listarModeradores/{{$grupo->id}}">Moderadores</a>
         <br>
         <a href="/grupos/listarPerfisExternos/{{$grupo->id}}">Perfis Externos</a>
         <br>
         <a href="/grupos/listarCuradorias/{{$grupo->id}}">Curadorias</a>
         <br>

         @if($grupo->getModeradores->contains(Auth::user()->id))
            <a href="/grupos/listarSolicitacoes/{{$grupo->id}}">Ver Solicitacoes Grupo</a>
         @endif

      </div>

      <div class="col-md-8">
         <div class="card">
            <div class="card-header">{{$grupo->name}}</div>
            <div class="card-body">
               @foreach($grupo->getPosts as $post)
               <hr style="border-style: inset; border-width: 1px; color: black;">
               <span> {{$post->texto}} </span>
               <hr>
               <p> {{$post->conteudo}} </p>
               <hr>
               <span style="float: right" >
                  <a href="/post/verPost/{{$post->id}}">Ver</a>
                  <br>
                  {{$post->getComentarios()->count()}}
                  comentarios
               </span>
               <br>
               <br>
               <span style=" font-size: 13px" > Por {{$post->users->name}} </span>
               <span style=" font-size: 13px" >

                  <?php
                     $data = '';
                   ?>

                   @php ($data = $post->created_at)

                  <?php
                     echo date( "H:i:s", strtotime($data)) . ' do dia ' . date( "d/m/Y", strtotime($data));
                   ?>

                </span>
               <hr style="border-style: inset; border-width: 1px; color: black;">
               @endforeach

            </div>
         </div>
      </div>
   </div>
</div>
@endsection
