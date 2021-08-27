@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                   <p>Token : 
                       {{request()->user()->token??'NA'}}
                  </p>
                  <p>Decrypt:  {{$decrypted}} 
               </p>
                    <form action="{{route('home')}}" method="post">
                        @csrf
                        <input type="text" name="secret" class="form-control">
                        <input type="submit" value="Generate token" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
