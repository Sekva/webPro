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


                <div class="card-body">{{$post->conteudo}}</div>
                <div>
                    <span style="float:right">
                        <a href="/post/verPost/{{$post->id}}">Ver Post!</a>
                    </span>
                </div>
            </div>
            <hr>
            <hr>
        </div>
    </div>
</div>

@endforeach


@endsection
