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

    {{-- Начало блока добавления группы --}}

    <a href="{{route('new_group')}}" class="btn btn-block btn-outline-info mb-4">Добавить группу</a>

    {{-- Конец блока добавления группы --}}
    {{-- <div class="row justify-content-center"> --}}
        {{-- <div class="col-12"> --}}
            <div class="card">
                <div class="card-header bg-info">Группы</div>

                <div class="card-body">

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Номер группы</th>
                                <th scope="col">Год поступления</th>
                                <th scope="col">Специальность</th>
                                <th scope="col">Отделение</th>
                                <th scope="col">Приказ о зачислении</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($grp as $item)
                            <tr>
                                <th scope="row">{{$item->id}}</th>
                                <td>{{$item->number}}</td>
                                <td>{{$item->year}}</td>
                                <td>{{$item->specialties->name}}</td>
                                <td>{{$item->departments->name}}</td>
                                {{-- <td>{{$item->orders->number}}</td> --}}
                                <td><a href="" class="btn btn-warning">Изменить</a>
                                    <form class="d-inline" action="{{route('delete_group', $item->id)}}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button class="btn btn-danger" onclick="return confirm('Удалить отделение?')">Удалить</button>
                                    </form>
                                </td>
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
