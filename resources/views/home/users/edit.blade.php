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

    {{-- <div class="row justify-content-center"> --}}
        {{-- <div class="col-12"> --}}
            <div class="card">
                <div class="card-header bg-info">Редактирование пользователя</div>
                <div class="card-body">
                    <form action="{{route('apply_edit_user', $user->id)}}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Фамилия</span>
                            </div>
                            <input type="text" name="familiya" class="form-control" placeholder="Фамилия" value="{{$user->familiya}}">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Имя</span>
                            </div>
                            <input type="text" name="imya" class="form-control" placeholder="Имя" value="{{$user->imya}}">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Отчество</span>
                            </div>
                            <input type="text" name="otchestvo" class="form-control" placeholder="Отчество" value="{{$user->otchestvo}}">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Отделение</span>
                            </div>
                            <select name="department" class="form-control">
                                <option value="">Не выбрано</option>
                                @foreach($department as $dep)
                                @if(!is_null($user->department))
                                    @if($dep->id == $user->department->id)
                                        <option value="{{$dep->id}}" class="form-control" selected>{{$dep->name}}</option>
                                    @else
                                        <option value="{{$dep->id}}" class="form-control">{{$dep->name}}</option>
                                    @endif
                                @else
                                    <option value="{{$dep->id}}" class="form-control">{{$dep->name}}</option>
                                @endif    
                                    @endforeach
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Должность</span>
                            </div>
                            <select name="role" class="form-control">
                                <option value="">Не выбрано</option>
                                @foreach($role as $item)
                                @if($item->id == $user->roles->first()->id)
                                    <option value="{{$item->id}}" class="form-control" selected>{{$item->name}}</option>
                                @else
                                    <option value="{{$item->id}}" class="form-control">{{$item->name}}</option>
                                @endif
                                    @endforeach
                            </select>
                        </div>

                        <input type="submit" class="btn btn-block btn-success" value="Применить изменения">
                    </form>
                </div>
            </div>
        </div>
        {{-- </div> --}}
</div>
@endsection
