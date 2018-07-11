@extends('layouts.app')

@section('content')





<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Perfil Externo</div>
                <div class="card-body">

                  <!-- Formulario -->

                  <form action="/home/salvar_perfilExterno" method="post">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                    <div class="form-group row">
                      <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nome:') }}</label>
                      <div class="col-md-6">
                        <input id="nome" type="text"  name="nome" value="{{ $perfilExterno->nome or '' }}" required autofocus>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Link:') }}</label>
                      <div class="col-md-6">
                        <input id="link" type="text"  name="link" value="{{ $perfilExterno->nome or '' }}" required autofocus>
                      </div>
                    </div>

                    <div class="form-group row mb-0">
                      <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                          {{ __('Register') }}
                        </button>
                      </div>
                    </div>

                  </form>

                  <!-- Formulario -->

                </div>
            </div>
        </div>
    </div>
</div>


@endsection
