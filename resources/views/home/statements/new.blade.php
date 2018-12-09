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

    <div class="card mb-3 ">
    <div class="card-header bg-info">
        Добавление отделения
    </div>
    <div class="card-body">
        <form action="{{ route('add_new_group')}}" method="POST" class="w-auto">
                {{ csrf_field() }}
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Номер группы</span>
                </div>
                <input type="text" name="number" class="form-control" placeholder="1">
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Год поступления</span>
                </div>
                <input type="text" name="year" class="form-control" placeholder="2018">
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Специальность</span>
                </div>
                <select name="spec" class="form-control">
                    <option value="">Не выбрано</option>
                    @foreach ($spec as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Отделение</span>
                </div>
                <select name="dep" class="form-control">
                    <option value="">Не выбрано</option>
                    @foreach ($dep as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Приказ о зачислении</span>
                </div>
                <select name="order" class="form-control">
                    <option value="">Не выбрано</option>
                    @foreach ($order as $item)
                        <option value="{{$item->id}}">{{$item->number}} от {{\Carbon\Carbon::parse($item->date)->format('d.m.Y')}}</option>
                    @endforeach
                </select>
            </div>

                <input type="submit" class="btn btn-outline-success btn-block" value="Добавить">
            </form>
        </div>
    </div>
{{-- Конец блока добавления группы --}}
</div>
@endsection