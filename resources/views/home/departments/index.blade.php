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

    {{-- Начало блока добавления отделения --}}

    @can('isAdmin', User::class) <a href="{{route('new_dep')}}" class="btn btn-block btn-outline-info mb-4">Добавить отделение</a> @endcan

    {{-- Конец блока добавления отделения --}}
    {{-- <div class="row justify-content-center"> --}}
        {{-- <div class="col-12"> --}}
            <div class="card">
                <div class="card-header bg-info">Отделения</div>

                <div class="card-body">

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Наименование</th>
                                @can('isAdmin', User::class) <th scope="col">Изменение/Удаление</th> @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dep as $item)
                            <tr>
                                <th scope="row">{{$item->id}}</th>
                                <td>{{$item->name}}</td>
                                @can('isAdmin', User::class)
                                <td><a href="" class="btn btn-warning">Изменить</a>
                                    <form class="d-inline" action="{{route('delete_dep', $item->id)}}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button class="btn btn-danger" onclick="return confirm('Удалить отделение?')">Удалить</button>
                                    </form>
                                </td>
                                @endcan
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        {{-- </div> --}}
</div>
@endsection
