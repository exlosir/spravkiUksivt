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

    {{-- Начало блока1 добавления приказа --}}
    @can('isAdmin', User::class)
    <div class="row">
        <div class="col-6">
            <a href="{{route('new_order')}}" class="btn btn-block btn-outline-info mb-4">Добавить приказ</a>
        </div>
        <div class="col-6">
            <a href="{{route('new_student_order')}}" class="btn btn-block btn-outline-info mb-4">Добавить студента к
                приказу</a>
        </div>
    </div>
    @endcan

    {{-- Конец блока добавления приказа --}}
    {{-- <div class="row justify-content-center"> --}}
        {{-- <div class="col-12"> --}}
            <div class="card">
                <div class="card-header bg-info">Приказы</div>

                <div class="card-body">

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Номер</th>
                                <th scope="col">Дата</th>
                                @can('isAdmin', User::class) <th scope="col">Изменение/Удаление</th>@endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order as $item)
                            <tr>
                                <th scope="row">{{$item->id}}</th>
                                <td>{{$item->number}}</td>
                                <td>{{ \Carbon\Carbon::parse($item->date)->format('d.m.Y')}}</td>
                                @can('isAdmin', User::class)
                                <td><a href="" class="btn btn-warning">Изменить</a>
                                    <form class="d-inline" action="{{route('delete_order', $item->id)}}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button class="btn btn-danger" onclick="return confirm('Удалить приказ?')">Удалить</button>
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