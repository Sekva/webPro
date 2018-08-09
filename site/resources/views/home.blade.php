@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">

      <div>
         <div style="margin-right:50px">
            <a href="/home/mudarFotoPerfil"><img src="{{ Auth::user()->foto }}" width="80" height="80"></a>
         </div>
         <br>
         <a href="{{url("/usuario/mostrarPerfil")}}">Ver meu Perfil!</a>
         <br>
         <a href="/home/novoPost">Novo Post</a>
         <br>
         <a href="/home/listarPosts">Listar Post</a>
         <br>
         <a href="/grupos">Grupos</a>
         <br>
         <a href="/amigos">Amigos</a>
      </div>

      <div class="col-md-8">
         <div class="card">
            <div class="card-header">Seu Feed de todo dia</div>

            <div class="card-body">
               @if (session('status'))
               <div class="alert alert-success" role="alert">
                  {{ session('status') }}
               </div>
               @endif
               Opa!
               <br><br>
               <?php
                  $listaPosts = Auth::user()->getPosts(Auth::user()->id);
                ?>

                @foreach(Auth::user()->getAmigos as $amigo)
                  @foreach($amigo->getPosts($amigo->id) as $posts)
                     @php($listaPosts->push($posts))
                  @endforeach
                @endforeach

                @php($saida = $listaPosts->sortByDesc('created_at'))

                @foreach($saida as $p)
                  @if($p->e_de_grupo == 0)
                  <div class="card">
                     @php($elo = \site\User::find($p->id_autor))
                     @if($elo->id == Auth::user()->id)
                        <div class="card-header" style=" background-color: #faa650; "> {{$p->texto}} </div>
                     @else
                        <div class="card-header"> {{$p->texto}} </div>
                     @endif
                     <div class="card-body">
                        <p>
                           <div id="<?php echo $p->id ?>" class="containerCodigo">
                              @php($conteudo = $p->conteudo)
                              <script type="text/javascript">
                                 interpretar(<?php echo json_encode($conteudo); ?>, "<?php echo $p->id ?>");
                              </script>
                           </div>
                        </p>
                        <div style=" margin-bottom: 20px;">
                            <span style="float:right">
                                <a href="/post/verPost/{{$p->id}}">Ver Post!</a>
                                <br>
                                {{\site\Post::find($p->id)->getComentarios()->count()}} comentarios
                            </span>
                        </div>
                     </div>


                     <span style=" font-size: 13px" >Por <a href="/amigos/ver/{{$elo->id}}">{{$elo->name}}</a></span>
                     <span style=" font-size: 13px" >

                        <?php
                           $data = '';
                         ?>

                         @php ($data = $p->created_at)

                        <?php
                           echo date( "H:i:s", strtotime($data)) . ' do dia ' . date( "d/m/Y", strtotime($data));
                         ?>

                     </span>

                  </div>
                  <br><br>
                  @endif
               @endforeach

            </div>
         </div>
      </div>
   </div>
</div>
@endsection
