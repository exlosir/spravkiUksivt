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

    <div class="card mb-3 ">
    <div class="card-header bg-info">
        Создание нового пользователя
    </div>
    <div class="card-body">
        <form action="{{ route('add_new_user')}}" method="POST" class="w-auto">
                {{ csrf_field() }}
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Фамилия</span>
                </div>
                <input type="text" name="familiya" class="form-control" placeholder="Фамилия">
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Имя</span>
                </div>
                <input type="text" name="imya" class="form-control" placeholder="Имя">
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Отчество</span>
                </div>
                <input type="text" name="otchestvo" class="form-control" placeholder="Отчество">
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Имя пользователя</span>
                </div>
                <input type="text" name="username" class="form-control" placeholder="Имя пользователя">
            </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" >Пароль</span>
                    </div>
                    <input type="password" name="password" class="form-control" placeholder="Пароль">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Повторите пароль</span>
                    </div>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Повторите пароль">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Отделение</span>
                    </div>
                    <select name="department" class="form-control">
                        <option value="">Не выбрано</option>
                        @foreach ($department as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Должность</span>
                    </div>
                    <select name="role" class="form-control">
                        <option value="">Не выбрано</option>
                        @foreach ($role as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>

                <input type="submit" class="btn btn-outline-success btn-block" value="Создать пользователя">
            </form>
        </div>
    </div>
{{-- Конец блока добавления нового пользователя --}}
</div>
@endsection