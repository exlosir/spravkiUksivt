@extends('layouts.app')
@extends('layouts.sidebar')

@yield('layouts.sidebar')
{{-- @include('layouts.sidebar') --}}
@section('main')
<div class="col-9">
    {{-- Начало блока ошибок --}}
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

    @if(\Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show p-4" role="alert">
        {!! session('success') !!}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    {{-- Конец блока ошибок --}}

    {{-- Начало блока добавления заявки --}}

    @can('isAdmin', User::class) <a href="{{route('new_group')}}" class="btn btn-block btn-outline-info mb-4">Добавить группу</a> @endcan

    {{-- Конец блока добавления заявки --}}
    {{-- <div class="row justify-content-center"> --}}
        {{-- <div class="col-12"> --}}
            <div class="card">
                <div class="card-header bg-info">Заявления</div>

                <div class="card-body">

                    <div class="row">
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header">
                                  Featured
                                </div>
                                <div class="card-body">
                                  <h5 class="card-title">Специальный заголовок</h5>
                                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                  <a href="#" class="btn btn-primary">Переход куда-нибудь</a>
                                </div>
                              </div>
                        </div>
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header">
                                  Featured
                                </div>
                                <div class="card-body">
                                  <h5 class="card-title">Специальный заголовок</h5>
                                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                  <a href="#" class="btn btn-primary">Переход куда-нибудь</a>
                                </div>
                              </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        {{-- </div> --}}
</div>
@endsection
