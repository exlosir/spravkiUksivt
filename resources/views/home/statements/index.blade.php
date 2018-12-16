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

    {{-- Начало блока добавления заявки --}}

    <div class="row">
        <div class="col-4">
            @can('isAdmin', User::class) <a href="/status" class="btn btn-block btn-outline-info mb-4">Статус заявки</a>
            @endcan
        </div>
        <div class="col-4">
            <a href="/spravka" class="btn btn-block btn-outline-info mb-4">Создать заявку</a>
        </div>
        <div class="col-4">
            <a href="{{route('get_journal')}}" class="btn btn-block btn-outline-info mb-4">Получить журнал заявок</a>
        </div>
    </div>
    

    <div class="card mb-4">
        <div class="card-header bg-info">Отображать только:</div>
        <div class="card-body">
            <a href="{{route('statements')}}" class="btn btn-info">Все</a>
            <a href="/home/statement/new" class="btn btn-warning">Новые</a>
            <a href="/home/statement/signature" class="btn btn-primary">На подписи</a>
            <a href="/home/statement/accept" class="btn btn-success">Готовые</a>
            <a href="/home/statement/decline" class="btn btn-danger">Отклоненные</a>
        </div>
    </div>

    {{-- Конец блока добавления заявки --}}
    {{-- <div class="row justify-content-center"> --}}
        {{-- <div class="col-12"> --}}
            <div class="card mb-2">
                <div class="card-header bg-info">Заявления</div>

                <div class="card-body">
                    @foreach ($statements as $item)
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="card">
                                @switch($item->status_zayav->name)
                                @case('Принята')
                                <div class="card-header text-center bg-warning">
                                    @break
                                    @case('Готова')
                                    <div class="card-header text-center bg-success">
                                        @break
                                        @case('На подписи')
                                        <div class="card-header text-center bg-primary">
                                            @break
                                            @case('Отклонена')
                                            <div class="card-header text-center bg-danger">
                                                @break
                                                @endswitch
                                                <div class="row">
                                                    <div class="col-6">
                                                        Заявка № <b>{{$item->identify}}</b>
                                                    </div>
                                                    <div class="col-6">
                                                        Статус - <b>{{$item->status_zayav->name}}</b>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                @if(!($item->spravka['id'] == NULL))
                                                <p><b>Номер справки - </b> {{$item->spravka['id']}} от {{\Carbon\Carbon::parse($item->spravka['date'])->format('d.m.Y')}}</p>
                                                <hr>
                                                @endif
                                                <p><b> Студент - </b> {{$item->familiya}} {{$item->imya}}
                                                    {{$item->otchestvo}} {{$item->year}} г.р. обучающийся в группе
                                                    {{$item->groups->year %
                                                    100}}{{$item->groups->specialties->short_name}}-{{$item->groups->number}}</p>
                                                <p>Запрашивает справку в <strong>{{$item->Organization}}</strong></p>
                                                <p>Требуемый тип справки - <b>{{$item->type_spravka->name}}</b></p>
                                                @if(!($item->comment == NULL))
                                                <hr>
                                                <p><b>Заявка отклонена по причине: </b> {{$item->comment}}</p>
                                                @endif
                                            </div>
                                            @if(!($item->status_zayav->name == 'Отклонена' ))
                                            <div class="card-footer">
                                                <div class="row text-center">
                                                    <div class="col-4">
                                                        @if($item->status_zayav->name == 'Принята')
                                                        <form method="POST" action="{{route('chstatus')}}">
                                                            {{csrf_field()}}
                                                            <input type="hidden" name="status" value="signature">
                                                            <input type="hidden" name="identify" value="{{$item->identify}}">
                                                            <input type="hidden" name="id" value="{{$item->id}}">
                                                            <button class="btn btn-info">На подписи</button>
                                                        </form>
                                                        @elseif($item->status_zayav->name == 'На подписи')
                                                        <form method="POST" action="{{route('chstatus')}}">
                                                            {{csrf_field()}}
                                                            <input type="hidden" name="status" value="accept">
                                                            <input type="hidden" name="id" value="{{$item->id}}">
                                                            <button href="" class="btn btn-success">Готова</button>
                                                        </form>
                                                        @endif
                                                    </div>
                                                    <div class="col-4">
                                                    </div>
                                                    <div class="col-4">
                                                        @if($item->status_zayav->name == 'Принята')
                                                        <button href="" class="btn btn-danger" data-toggle="modal"
                                                            data-target="#declineZayav" data-id="{{$item->id}}"
                                                            data-fio="{{$item->familiya.' '.$item->imya.' '.$item->otchestvo}}">Отклонить</button>
                                                        @endif
                                                        @if($item->status_zayav->name == 'На подписи' or $item->status_zayav->name == 'Готова')
                                                            <button class="btn btn-info" data-toggle="modal" data-target="#createSpravka" data-id="{{$item->id}}">Создать справку</button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                    {{-- </div> --}}
            </div>


            <div class="modal" tabindex="-1" role="dialog" id="declineZayav">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-danger">
                            <h5 class="modal-title">Отклонение заявки </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{route('chstatus')}}">
                                {{csrf_field()}}
                                <input type="hidden" name="id">
                                <input type="hidden" name="status" value="decline">
                                <input type="text" name="report" class="form-control" placeholder="Введите причину отклонения заявки">
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-success" value="Отклонить">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal" tabindex="-1" role="dialog" id="createSpravka">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-success">
                            <h5 class="modal-title">Создание справки</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="GET">
                                {{csrf_field()}}
                                <h5>Выберите пол студента</h5>
                                <select name="gender" class="form-control">
                                    <option value="man">Мужчина</option>
                                    <option value="woman">Женщина</option>
                                </select>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-success" value="Создать">
                        </form>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                        </div>
                    </div>
                </div>
            </div>

            @endsection
