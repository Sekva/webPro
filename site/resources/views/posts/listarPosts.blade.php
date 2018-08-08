@extends('layouts.app')

@section('content')

@foreach($posts as $post)

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header">
                    <span>{{$post->texto}}</span>
                    <span style="float:right; margin-left:10px;">
                        <a href="/home/deletarPost/{{$post->id}}" onclick="return confirm('Certeza que quer apagar este post?')" >Apagar!</a>
                    </span> <span style="float:right">
                        <a href="/home/editarPost/{{$post->id}}">Editar!</a>
                    </span>
                    <br>
                    @if($post->e_de_grupo)
                        Do grupo
                        @php($grupo = \site\Grupo::find(DB::table('posts_grupos')->where('id_post', $post->id)->value('id_grupo')))
                        @if($grupo)
                           <a href="/grupos/ver/{{DB::table('posts_grupos')->where('id_post', $post->id)->value('id_grupo')}}">
                           {{ DB::table('grupos')->where('id', DB::table('posts_grupos')->where('id_post', $post->id)->value('id_grupo'))->value('name')}}
                        @else
                           que foi deletado
                        @endif
                        </a>
                    @endif
                </div>
                @php($elo = \site\User::find($post->id_autor))
                <div class="card-body">
                   <div>
                       <span style="float:right">
                           <a href="/post/verPost/{{$post->id}}">Ver Post!</a>
                           <br>
                           {{\site\Post::find($post->id)->getComentarios()->count()}} comentarios
                       </span>
                   </div>
                   <p> {{$post->conteudo}} </p>
                </div>

                <span style=" font-size: 13px" >Por <a href="/amigos/ver/{{$elo->id}}">{{$elo->name}}</a></span>
                <span style=" font-size: 13px" >

                   <?php
                      $data = '';
                    ?>

                    @php ($data = $post->created_at)

                   <?php
                      echo date( "H:i:s", strtotime($data)) . ' do dia ' . date( "d/m/Y", strtotime($data));
                    ?>

                </span>
            </div>
            <hr>
            <hr>
        </div>
    </div>
</div>

@endforeach


@endsection
