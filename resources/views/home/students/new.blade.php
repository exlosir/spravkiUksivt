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

    <div class="card mb-3 ">
    <div class="card-header bg-info">
        Добавление студента
    </div>
    <div class="card-body">
        <form action="{{ route('add_new_student')}}" method="POST" class="w-auto">
                {{ csrf_field() }}
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Фамилия</span>
                </div>
                <input type="text" name="familiya" class="form-control" placeholder="Иванов">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Имя</span>
                </div>
                <input type="text" name="imya" class="form-control" placeholder="Иван">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Отчество</span>
                </div>
                <input type="text" name="otchestvo" class="form-control" placeholder="Иванович">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Год рождения</span>
                </div>
                <input type="text" name="year" class="form-control" placeholder="2002">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Группа</span>
                </div>
                <select name="group" class="form-control">
                    <option value="">Не выбрано</option>
                    @foreach ($groups as $item)
                        <option value="{{$item->id}}">{{mb_substr($item->year,2,2)}}{{$item->specialties->short_name}}-{{$item->number}}</option>
                    @endforeach
                </select>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Основа обучения</span>
                </div>
                <select name="osn_obuch" class="form-control">
                    <option value="">Не выбрано</option>
                    @foreach ($osn as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Статус</span>
                </div>
                <select name="status" class="form-control">
                    <option value="">Не выбрано</option>
                    @foreach ($status as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
            </div>


                <input type="submit" class="btn btn-outline-success btn-block" value="Добавить">
            </form>
        </div>
    </div>
{{-- Конец блока добавления студента --}}
</div>
@endsection