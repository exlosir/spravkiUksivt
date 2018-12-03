@extends('layouts.app')
@extends('layouts.sidebar')

<div class="row">
@yield('layouts.sidebar')
@section('main')
    <div class="col-9">

        @if($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ $error }} 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endforeach
        @endif

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @foreach ($user->roles->pluck('name') as $item)
                        {{$item}}
                    @endforeach
                    
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
</div>