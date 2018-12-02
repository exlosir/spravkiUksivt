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

{{-- Начало блока добавления нового пользователя --}}

<a href="{{route('new_user')}}" class="btn btn-block btn-outline-info mb-4">Создать нового пользователя</a>

{{-- Конец блока добавления нового пользователя --}}
    {{-- <div class="row justify-content-center"> --}}
        {{-- <div class="col-12"> --}}
            <div class="card">
                <div class="card-header bg-info">Пользователи</div>

                <div class="card-body">

                    <table class="table table-striped">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Имя</th>
                            <th scope="col">Фамилия</th>
                            <th scope="col">Отчество</th>
                            <th scope="col">Отделение</th>
                            <th scope="col">Должность</th>
                            <th scope="col">Изменение/Удаление</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $item)
                            <tr>
                                <th scope="row">{{$item->id}}</th>
                                <td>{{$item->imya}}</td>
                                <td>{{$item->familiya}}</td>
                                <td>{{$item->otchestvo}}</td>
                                <td>
                                    @if(!$item->department == null)
                                        {{$item->department->name}}
                                    @endif
                                </td>
                                <td>
                                    @foreach ($item->roles as $role)
                                    <span class="badge badge-pill badge-primary mb-1">{{$role->name}}</span> <br>
                                    @endforeach
                                </td>
                                <td><a href="" class="btn btn-warning">Изменить</a>
                                    <form class="d-inline" action="{{route('delete_user', $item->id)}}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button class="btn btn-danger" onclick="return confirm('Удалить пользователя?')">Удалить</button>
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