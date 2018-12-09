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

    {{-- Начало блока добавления студента --}}

    @can('isAdmin', User::class) <a href="{{route('new_student')}}" class="btn btn-block btn-outline-info mb-4">Добавить студента</a> @endcan

    {{-- Конец блока добавления студента --}}
    {{-- <div class="row justify-content-center"> --}}
        {{-- <div class="col-12"> --}}
            <div class="card">
                <div class="card-header bg-info">Студенты</div>

                <div class="card-body">

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">ФИО</th>
                                <th scope="col">Год рождения</th>
                                <th scope="col">Группа</th>
                                <th scope="col">Основа обучения</th>
                                <th scope="col">Статус</th>
                                @can('isAdmin', User::class) <th scope="col">Изменение/Удаление</th> @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $item)
                            <tr>
                                <th scope="row">{{$item->id}}</th>
                                <td>{{$item->familiya}} {{$item->imya}} {{$item->otchestvo}}</td>
                                <td>{{$item->year}}</td>
                                <td>{{$item->groups->year % 100}}{{$item->groups->specialties->short_name}}-{{$item->groups->number}}</td>
                                <td>{{$item->osnova->name}}</td>
                                <td>{{$item->statuses->name}}</td>
                                @can('isAdmin', User::class)
                                <td><a href="" class="btn btn-warning">Изменить</a>
                                    <form class="d-inline" action="{{route('delete_student', $item->id)}}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button class="btn btn-danger" onclick="return confirm('Удалить студента?')">Удалить</button>
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
