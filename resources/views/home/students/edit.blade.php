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
                <div class="card-header bg-info">Редактирование студента</div>
                <div class="card-body">
                    <form action="{{route('apply_edit_student', $student->id)}}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">ФИО</span>
                            </div>
                            <input type="text" name="fio" class="form-control" placeholder="Иванов Иван Иванович" value="{{$student->familiya}} {{$student->imya}} {{$student->otchestvo}}">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Год рождения</span>
                            </div>
                            <input type="text" name="year" class="form-control" placeholder="Год поступления" value="{{$student->year}}">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Группа</span>
                            </div>
                            <select name="group" class="form-control">
                                <option value="">Не выбрано</option>
                                @foreach($group as $item)
                                @if(!is_null($student->groups))
                                    @if($item->id == $student->groups->id)
                                        <option value="{{$item->id}}" class="form-control" selected>{{$item->year % 100}}{{$item->specialties->short_name}}-{{$item->number}}</option>
                                    @else
                                        <option value="{{$item->id}}" class="form-control">{{$item->year%100}}{{$item->specialties->short_name}}-{{$item->number}}</option>
                                    @endif
                                @else
                                    <option value="{{$item->id}}" class="form-control">{{$item->year%100}}{{$item->specialties->short_name}}-{{$item->number}}</option>
                                @endif    
                                    @endforeach
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Основа обучения</span>
                            </div>
                            <select name="osnova" class="form-control">
                                <option value="">Не выбрано</option>
                                @foreach($osnova as $item)
                                @if(!is_null($student->osnova))
                                    @if($item->id == $student->osnova->id)
                                        <option value="{{$item->id}}" class="form-control" selected>{{$item->name}}</option>
                                    @else
                                        <option value="{{$item->id}}" class="form-control">{{$item->name}}</option>
                                    @endif
                                @else
                                    <option value="{{$item->id}}" class="form-control">{{$item->name}}</option>
                                @endif    
                                    @endforeach
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Статус</span>
                            </div>
                            <select name="status" class="form-control">
                                <option value="">Не выбрано</option>
                                @foreach($status as $item)
                                @if(!is_null($student->statuses))
                                    @if($item->id == $student->statuses->id)
                                        <option value="{{$item->id}}" class="form-control" selected>{{$item->name}}</option>
                                    @else
                                        <option value="{{$item->id}}" class="form-control">{{$item->name}}</option>
                                    @endif
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
