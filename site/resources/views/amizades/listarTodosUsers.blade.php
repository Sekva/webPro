@extends('layouts.app')

@section('content')


  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-8">
             @foreach($users as $user)
              <div class="card">

                 @if($user->id != Auth::user()->id)
                  <div class="card-header">
                    <span>
                       {{$user->name}}
                    </span>
                    <span style="float:right">
                      <a href="/amigos/ver/{{$user->id}}">Ver</a>
                    </span>
                  </div>

                  <div class="card-body">
                     <span style="float:left">
                        <img src="{{$user->foto}}" width="50" height="50">
                     </span>

                     {{$user->descricao}}

                  </div>
                  @endif
              </div>
              <hr>
              <hr>
              @endforeach
              <div class="col-md-4" style=" margin-right: auto; margin-left: auto;">
                 {{ $users->links() }}
              </div>
          </div>
      </div>
  </div>



@endsection
