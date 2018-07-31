@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">

        <div class="card-header">Novo Curadoria</div>

        <div class="card-body">

          <!-- Formulario -->

          <form action="/home/salvarNovaCuradoria" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />

            <div class="form-group row">
              <div class="col-md-6">
                <span>Nome: </span>
                <input type="text" name="nome">
              </div>
            </div>

            <div class="form-group row">
              <div class="col-md-6">
                <span>Descrição: </span>
                <input type="text" name="descricao">
              </div>
            </div>

            <div class="form-group row">
              <div class="col-md-6">
                <span>Link: </span>
                <input type="text" name="link">
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
