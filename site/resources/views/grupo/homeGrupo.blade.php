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
         <a href="/grupos/listarMembros/{{$grupo->id}}">Membros</a>
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
            <div class="card-header">
               {{$grupo->name}}
            </div>
            <div class="card-body">
               @php($postsOrdenados = $grupo->getPosts->sortByDesc('created_at'))
               @foreach($postsOrdenados as $post)

               @php($elo = \site\User::find($post->id_autor))
               @if($elo->id == Auth::user()->id)
               <div class="card-header" style=" background-color: #faa650; "> {{$post->texto}} </div>
               @else
               <div class="card-header"> {{$post->texto}} </div>
               @endif

               <div class="card-body">

                  <hr style="border-style: inset; border-width: 1px; color: black;">
                  <hr>
                  <p>
                     <div id="<?php echo $post->id ?>" class="containerCodigo">
                       @php($conteudo = $post->conteudo)
                       <script type="text/javascript">
                          interpretar(<?php echo json_encode($conteudo); ?>, "<?php echo $post->id ?>");
                       </script>
                     </div>
                  </p>
                  <hr>
                  <span style="float: right" >
                     <a href="/post/verPost/{{$post->id}}">Ver</a>
                     <br>
                     {{$post->getComentarios()->count()}}
                     comentarios
                  </span>
                  <br>
                  <br>

                  @if($grupo->getModeradores->contains(Auth::user()->id))
                  <span> <a href="/grupos/deletarPost/{{$grupo->id}}/{{$post->id}}" onclick="return confirm('Certeza que quer apagar este post?')">Deletar</a> </span>
                  @endif
                  <br>

                  <span style=" font-size: 13px" > Por <a href="/amigos/ver/{{$post->users->id}}">{{$post->users->name}}</a> </span>
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
               </div>
               @endforeach

            </div>
         </div>
      </div>
   </div>
</div>
@endsection
