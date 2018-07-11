@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="">
        <a href="/home/mudarFotoPerfil"><img src="{{ Auth::user()->foto }}" width="80" height="80"></a>
      </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
