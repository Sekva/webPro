@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">

        <div class="card-header">Editar Perfil Externo</div>

        <div class="card-body">

          <!-- Formulario -->

          <form action="/home/salvar_perfilExternoEdit" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <input type="hidden" name="id" value="{{$perfil_externo->id}}">

            <div class="form-group row">
              <div class="col-md-6">
                <span>Nome: </span>
                <input type="text" name="nome" value="{{$perfil_externo->nome}}">
              </div>
            </div>

            <div class="form-group row">
              <div class="col-md-6">
                <span>Link: </span>
                <input type="text" name="link" value="{{$perfil_externo->link}}">
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
