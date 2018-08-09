@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">

        <div class="card-header">Editar post {{$post->texto}}</div>

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

          <form action="/home/salvar_editarPost" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <input type="hidden" name="id" value="{{$post->id}}">
            <input type="hidden" name="texto" value="{{$post->texto}}">

            <div class="form-group row">
              <div class="col-md-6">
                <textarea name="conteudo" rows="8" cols="73" onkeydown="habilitarTextArea()" >{{$post->conteudo}}</textarea>
              </div>
            </div>

            <div class="form-group row mb-0">
              <div class="col-md-6 offset-md-5">
                <button type="submit" class="btn btn-primary">
                  {{ __('Ok!') }}
                </button>
              </div>
            </div>

          </form>

          <!-- Formulario -->



        </div>
      </div>
      <hr>
      <hr>
    </div>
  </div>
</div>

@endsection
