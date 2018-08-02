@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">

        <div class="card-header">Editar Curadoria</div>

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

          <form action="/grupos/salvar_editarCuradoria" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <input type="hidden" name="id" value="{{$curadoria->id}}">
            <input type="hidden" name="id_grupo" value="{{$grupo->id}}">

            <div class="form-group row">
              <div class="col-md-6">
                <span>Nome: </span>
                <input type="text" name="nome" value="{{$curadoria->nome}}">
              </div>
            </div>

            <div class="form-group row">
              <div class="col-md-6">
                <span>Link: </span>
                <input type="text" name="link" value="{{$curadoria->link}}">
              </div>
            </div>

            <div class="form-group row">
              <div class="col-md-6">
                Descrição:
                <textarea name="descricao" rows="6" cols="73">{{$curadoria->descricao}}</textarea>
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
