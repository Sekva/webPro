@extends('layouts.app')

@section('content')

<?php

$eAmigo = 0;

?>

<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-8">
         <div class="card">
            <div class="card-header">
               <span style="float: left" >
                  <img src="{{$user->foto}}" alt="{{$user->name}}" width="50" height="50">
                  <h2>
                     {{$user->name}}
                  </h2>
               </span>

               @if(Auth::user())
                  @if(Auth::user()->id != $user->id)
                     @foreach(Auth::user()->getAmigos as $amigo)
                        @if($amigo->id == $user->id)
                           <?php $eAmigo = 1;?>
                        @endif
                     @endforeach
                     <?php
                        $euSolicitei = false;
                        $euFuiSolicitado = false;
                        //Se não são amigos
                        if($eAmigo != 1) {
                           $solicitacoesUserAtual = Auth::user()->getPedidosAmizadeEnviados;
                           //Verifica se o usuário atual foi solicitado por o dono do perfil
                           foreach ($solicitacoesUserAtual as $s) {
                              if($s->id == $user->id) {
                                 $euSolicitei = true;
                              }
                           }
                           $solicitacoesDonoPage = $user->getPedidosAmizadeEnviados;
                           //Verifica se o dono do perfil solicitou o usuário atual
                           foreach ($solicitacoesDonoPage as $s) {
                              if($s->id == Auth::user()->id) {
                                 $euFuiSolicitado = true;
                              }
                           }
                        }
                        // Nunca vai ser true e true
                     ?>

                     @if($euSolicitei == true)
                        <span style="float:right">
                           <a href="/amigos/cancelarSolicitacao/{{$user->id}}" onclick="return confirm('Certeza?')">Cancelar Solicitação</a>
                        </span>
                     @elseif($euFuiSolicitado == true)
                        <span style="float:right">
                           <a href="/amigos/aceitarAmizade/{{$user->id}}" onclick="return confirm('Certeza?')">Aceitar amizade! \o/</a>
                           <a href="/amigos/recusarAmizade/{{$user->id}}" onclick="return confirm('Certeza?')">Recusar amizade!</a>
                        </span>
                     @elseif($eAmigo == 1)
                        <span style="float:right">
                           <a href="/amigos/desfazerAmizade/{{$user->id}}" onclick="return confirm('Certeza?')">Desfazer Amizade ;-( </a>
                        </span>
                     @else
                     <span style="float:right">
                           <a href="/amigos/solicitarAmizade/{{$user->id}}"> Solicitar Amizade </a>
                        </span>
                     @endif
                  @endif
               @endif


               <span style="float:right">
                  <br>
                  <a href="/amigos/perfisExternosAmigos/{{$user->id}}">Perfis Externos</a>
                  <br>
                  <a href="/amigos/curadoriasAmigos/{{$user->id}}">Curadorias</a>
                  <br>
                  <a href="/amigos/listarAmigosDeOutro/{{$user->id}}">Ver Amigos</a>
               </span>



            </div>
            <div class="card-body">
               <input type="hidden" name="id" value="{{$user->id}}" />
               <b>E-mail:</b> {{$user->email}}</br>
               <b>Descrição:</b> {{$user->descricao}}</br>
               @foreach($user->getPerfisExternos as $p)
                  @if($p->nome != null)
                     <hr>
                     <b>Nome do Perfil Externo:</b> {{$p->nome}}</br>
                     <b>Link do Perfil Externo:</b> {{$p->link}}</br>
                  @else
                     <b>Nome do Perfil Externo:</b> {{'Perfil Externo incompleto ou não feito'}}</br>
                     <b>Link do Perfil Externo:</b> {{'Perfil Externo incompleto ou não feito'}}</br>
                  @endif
               @endforeach
               <hr>
            </div>
         </div>
         <hr>
         <hr>
      </div>
   </div>
</div>

@endsection
