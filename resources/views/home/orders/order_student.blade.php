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

    {{-- Начало блока добавления приказа --}}
    <div class="row">
        <div class="col-6">
            <a href="{{route('new_order')}}" class="btn btn-block btn-outline-info mb-4">Добавить приказ</a>
        </div>
        <div class="col-6">
            <a href="{{route('new_student_order')}}" class="btn btn-block btn-outline-info mb-4" data-toggle="modal"
                data-target="#selectStudent">Добавить студента к приказу</a>
        </div>
    </div>

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
                                <th scope="col">Студент</th>
                                <th scope="col">Приказ</th>
                                <th scope="col">Тип приказа</th>
                                <th scope="col">Изменение/Удаление</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order as $item)
                            <tr>
                                <th scope="row">{{$item->id}}</th>
                                <td>{{$item->number}}</td>
                                <td>{{ \Carbon\Carbon::parse($item->date)->format('d.m.Y')}}</td>
                                @if($item->student !== null)
                                @if($item->student->first() !== null)
                                    <td>{{$item->student->first()->order_student->type_orders->name}}</td>
                                @else
                                    <td></td>
                                @endif
                                @endif
                                <td><a href="" class="btn btn-warning">Изменить</a>
                                    <form class="d-inline" action="{{route('delete_dep', $item->id)}}" method="POST">
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


    <div class="modal" tabindex="-1" role="dialog" id="selectStudent">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title">Поиск студента</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <form method="POST" action="{{route('add_new_student_order')}}">
                        @csrf
                </div>
                <div class="modal-body">
                    <div class="accordion" id="accordionExample">
                        <div class="card mb-2">
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#student"
                                        aria-expanded="true" aria-controls="collapseOne">
                                        Студенты
                                    </button>
                                </h5>
                            </div>

                            <div id="student" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Поиск</span>
                                        </div>
                                        <input type="text" name="search" class="form-control" placeholder="Фамилия,Имя,Отчество или год рождения">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-info" id="searchStudent">Найти</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-body students_field">
                                        @foreach($student as $item)
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="student" value="{{$item->id}}">{{$item->familiya
                                                . ' ' . $item->imya . ' ' . $item->otchestvo . ' - ' .
                                                $item->groups->year%100 .''. $item->groups->specialties->short_name
                                                .'-'.$item->groups->number}}
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>

                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingTwo">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                            data-target="#order" aria-expanded="false" aria-controls="order">
                                            Приказы
                                        </button>
                                    </h5>
                                </div>
                                <div id="order" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                    <div class="card-body">
                                        @foreach($order as $item)
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="order" value="{{$item->id}}">{{$item->number
                                                . ' от '. \Carbon\Carbon::parse($item->date)->format('d.m.Y')}}
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="input-group">
                            <select name="type" class="form-control">
                                <option value="">Не выбрано</option>
                                @foreach($type as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-success" value="Завершить">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection
