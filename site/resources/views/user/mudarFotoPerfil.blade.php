@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Perfil Externo</div>
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

                  <form action="/home/salvar_fotoPerfil" method="post" enctype="multipart/form-data">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                    <div class="form-group row">
                      <label for="foto" class="col-md-4 col-form-label text-md-right">{{ __('Foto') }}</label>

                      <div class="col-md-6">
                        <input id="foto" type="file" name="foto">
                      </div>
                    </div>

                    <div class="form-group row mb-0">
                      <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                          {{ __('Salvar') }}
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
