@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Novo Post (por enquanto fica aqui) </div>
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

                  <form action="/home/salvar_novoPost" method="post" enctype="multipart/form-data">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />


                    <div class="form-group row">
                      <label for="foto" class="col-md-4 col-form-label text-md-right">{{ __('Titulo') }}</label>

                      <div class="col-md-6">
                        <input id="texto" type="text" name="texto">
                      </div>
                    </div>

                    <div class="form-group row">
                      <!-- <label for="foto" class="col-md-4 col-form-label text-md-top">{{ __('Conteudo') }}</label> -->

                      <div class="col-md-6">
                        <div style=" text-align: center; margin-left: 70%">
                           <span>Conteudo</span>
                        </div>
                        <textarea name="conteudo" rows="8" cols="73" onkeydown="habilitarTextArea()" placeholder="Use  ;;lang=alguma_lang  para iniciar o codigo."></textarea>
                      </div>
                    </div>

                    <div class="form-group row mb-0">
                      <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                          {{ __('Postar!') }}
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
<br><br>
<div style=" text-align: center; ">
 <a href="/ajuda/postCodigo">Como uso o bloco de codigo?</a>
</div>

@endsection
