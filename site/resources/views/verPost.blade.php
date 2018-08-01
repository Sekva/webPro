@extends('layouts.app')

@section('content')


<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-8">
         <div class="card">

            <form action="/comentar" method="post" enctype="multipart/form-data">
               {{ csrf_field() }}
               <div class="card-header">
                  <span>{{$post->texto}}</span>
                  @if ($post->id_autor == Auth::user()->id)
                  <span style="float:right; margin-left:10px;">
                     <a href="/home/deletarPost/{{$post->id}}">Apagar!</a>
                  </span>
                  <span style="float:right">
                     <a href="/home/editarPost/{{$post->id}}">Editar!</a>
                  </span>
                  @endif
               </div>

               <div class="card-body">{{$post->conteudo}}</div>
               <hr>
               <input type="hidden" name="post_id" value="{{$post->id}}">
               <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
               <div>
                  <textarea name="conteudo" rows="5" cols="73"></textarea>
               </div>
               <!-- <a href="/comentar">comentar!</a> -->

               <!-- <div>
                     <a href="{{url("/comentar")}}">
                         <button class="btn btn-primary" name="button">Postar Comentário!</button>
                     </a>
               </div> -->
               <button type="submit" class="btn btn-primary">
                 {{ __('Comentar! \o/') }}
               </button>
             </div>
            </form>

            <?php
               //Pega os nomes dos autores dos comentários e salva em nomes
               $nomes = $autores->map(function($aut){
                  return $aut->name;
               });
               $cont = 0;
            ?>
            @foreach($comentarios as $c)
               @if ($c->id_autor == Auth::user()->id)
               <span style="float:right; margin-left:10px;">
                  <a href="/deletarComentario/{{$c->id}}">Apagar Comentário!</a>
               </span>
               @endif
               {{$c->conteudo}}
               <br>
               <span style="float:right">
                  <?php
                  //Printa o nome do dono do comentario
                     echo "Autor: ".$nomes[$cont];
                     $cont = $cont + 1;
                  ?>
               </span>
               <br><hr>
            @endforeach
         </div>
      </div>
   </div>
</div>


   @endsection
