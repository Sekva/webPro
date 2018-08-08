@extends('layouts.app')

@section('content')


<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-8">
         <div class="card">


            <form action="/comentar" method="post" enctype="multipart/form-data">
               {{ csrf_field() }}
               @php($elo = \site\User::find($post->id_autor))
               @if(Auth::user())
                  @if($elo->id == Auth::user()->id)
                     <div class="card-header" style=" background-color: #faa650; "> <span>{{$post->texto}}</span>
                        @if(Auth::user())
                           @if ($post->id_autor == Auth::user()->id)
                              <span style="float:right; margin-left:10px;">
                                 <a href="/home/deletarPost/{{$post->id}}" onclick="return confirm('Certeza que quer apagar este post?')" >Apagar!</a>
                              </span>
                              <span style="float:right">
                                 <a href="/home/editarPost/{{$post->id}}">Editar!</a>
                              </span>
                           @endif
                        @endif
                     </div>
                  @else
                     <div class="card-header"> <span>{{$post->texto}}</span>
                        @if(Auth::user())
                           @if ($post->id_autor == Auth::user()->id)
                              <span style="float:right; margin-left:10px;">
                                 <a href="/home/deletarPost/{{$post->id}}" onclick="return confirm('Certeza que quer apagar este post?')" >Apagar!</a>
                              </span>
                              <span style="float:right">
                                 <a href="/home/editarPost/{{$post->id}}">Editar!</a>
                              </span>
                           @endif
                        @endif
                     </div>
                  @endif
               @endif

               <div class="card-body">{{$post->conteudo}}</div>

               @if ($errors->any())
                  <div class="alert alert-danger">
                     <ul>
                        @foreach ($errors->all() as $error)
                           <li>{{ $error }}</li>
                        @endforeach
                     </ul>
                  </div>
               @endif
               <hr>
               <span>Por <a href="/amigos/ver/{{$elo->id}}">{{$elo->name}}</a></span>

               <span style=" font-size: 13px" >

                  <?php
                     $data = '';
                   ?>

                   @php ($data = $post->created_at)

                  <?php
                     echo 'em ' . date( "H:i:s", strtotime($data)) . ' do dia ' . date( "d/m/Y", strtotime($data));
                   ?>

               </span>

               <hr>
               <input type="hidden" name="post_id" value="{{$post->id}}">
               @if(Auth::user())
                  <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                  <div>
                     <textarea name="conteudo" rows="5" cols="73"></textarea>
                  </div>
                  <button type="submit" class="btn btn-primary">
                     {{ __('Comentar! \o/') }}
                  </button>
               @endif
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
            @if(Auth::user())
               @if ($c->id_autor == Auth::user()->id)
                  <span style="float:right; margin-left:10px;">
                     <a href="/deletarComentario/{{$c->id}}" onclick="return confirm('Certeza que quer apagar este comentário?')" >Apagar Comentário!</a>
                  </span>
               @endif
            @endif
            {{$c->conteudo}}
            @php($autor = \site\User::find($c->id_autor))
            <br>
            <span style="float:right">
               <?php
               //Printa o nome do dono do comentario
               echo "Autor: " . "<a href=/amigos/ver/$autor->id>" .$nomes[$cont]. "</a>";
               $cont = $cont + 1;
               ?>
            </span>
            <br><hr>
         @endforeach
      </div>
   </div>
</div>

@endsection
