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

    {{-- Начало блока добавления специальности --}}

    @can('isAdmin', User::class) <a href="{{route('new_spec')}}" class="btn btn-block btn-outline-info mb-4">Добавить специальность</a> @endcan

    {{-- Конец блока добавления специальности --}}
    {{-- <div class="row justify-content-center"> --}}
        {{-- <div class="col-12"> --}}
            <div class="card">
                <div class="card-header bg-info">Специальности</div>

                <div class="card-body">

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Наименование</th>
                                <th scope="col">Краткое наименование</th>
                                <th scope="col">Период обучения</th>
                                @can('isAdmin', User::class) <th scope="col">Изменение/Удаление</th>@endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($spec as $item)
                            <tr>
                                <th scope="row">{{$item->id}}</th>
                                <td>{{$item->name}}</td>
                                <td>{{$item->short_name}}</td>
                                <td>{{$item->period_obuch}}</td>
                                @can('isAdmin', User::class)
                                <td>
                                    <form action="{{route('edit_spec',$item->id)}}" method="get" class="d-inline">
                                        @csrf
                                        <button class="btn btn-warning">Изменить</button>
                                    </form>
                                    <form class="d-inline" action="{{route('delete_spec', $item->id)}}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button class="btn btn-danger" onclick="return confirm('Удалить специальность?')">Удалить</button>
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
