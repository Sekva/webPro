@extends('layouts.app')

@section('content')


<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-8">
         <div class="card">
            <div class="card-header">Seu Perfil</div>
            <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

               <!-- Formulario -->

               <form action="/usuario/salvarEdicao" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="_token" value="{{csrf_token()}}" />
                  <input type="hidden" name="id" value="{{$user->id}}" />
                  <input type="hidden" name="foto" value="{{$user->foto}}">

                  <div class="form-group row">
                     <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nome:') }}</label>
                     <div class="col-md-6">
                        <input type="text" name="name" value="{{$user->name}}" required>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('E-mail:') }}</label>
                     <div class="col-md-6">
                        <input type="text" name="email" value="{{$user->email}}" required>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Senha:') }}</label>
                     <div class="col-md-6">
                        <input type="password" name="password" value="{{$user->senha}}" required maxlength="16" minlength="6">
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Descrição:') }}</label>
                     <div class="col-md-6">
                        <input type="text" name="descricao" value="{{$user->descricao}}">
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Foto:') }}</label>
                     <div class="col-md-6">
                        <a href="{{url("/home/mudarFotoPerfil")}}">
                           <img width="256" height="205" src="{{$user->foto}}">
                        </a>
                     </div>
                  </div>
                  <hr>
                  <h3>Aplicar Mudanças!</h3>
                  <button class="btn btn-primary" name="button" onclick="return confirm('Confirmar Edição?')">Aplicar</button>

               </form>
               <br><hr>
               @if(!$perfisExternos->isEmpty())
                  <hr>
                  <h2>Perfis Externos</h2>
                  @foreach($perfisExternos as $p)
                     <b>Nome do Perfil Externo:</b> {{$p->nome}}</br>
                     <b>Link do Perfil Externo:</b> {{$p->link}}</br>
                  @endforeach
               @endif
               <div style="text-align:center;">
                  <a href="{{url("/home/perfilExterno")}}">
                     <button class="btn btn-primary" name="button">Editar Perfil Externo</button>
                  </a>
               </div>
               @if(!$curadorias->isEmpty())
                  <hr>
                  <h2>Curadorias</h2>
                  @foreach($curadorias as $c)
                     <b>Nome da Curadoria:</b> {{$c->nome}}</br>
                     <b>Descrição da Curadoria:</b> {{$c->descricao}}</br>
                     <b>Link da Curadoria:</b> {{$c->link}}</br>
                  @endforeach
               @endif
               <hr>
               <div style="text-align:center;">
                  <a href="{{url("/home/curadorias")}}">
                     <button class="btn btn-primary" name="button">Editar Curadorias</button>
                  </a>
               </div>

            </div>
         </div>
      </div>
   </div>
</div>


@endsection
