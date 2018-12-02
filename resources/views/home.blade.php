@extends('layouts.app')
@extends('layouts.sidebar')

<div class="row">
@yield('layouts.sidebar')
@section('main')
    <div class="col-9">
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