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
                    <div class="card-header">Панель управления</div>

                    <div class="card-body">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                            <h5><b>Фамилия:</b> {{$user->familiya}}</h5>
                            <h5><b>Имя:</b> {{$user->imya}}</h5>
                            <h5><b>Отчество:</b> {{$user->otchestvo}}</h5>
                            <h5><b>Отделение:</b> {{$user->department->name}}</h5>
                            <h5 class="d-inline"><b> Должность:</b></h5>
                            @foreach ($user->roles as $item)
                            <span class="badge badge-pill badge-primary mb-1"> {{$item->name}} </span>
                            @endforeach


                        {{-- You are logged in! --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
</div>
