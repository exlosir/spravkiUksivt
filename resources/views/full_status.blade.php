@extends('layouts.app')

@section('main')
    <div class="container">
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
            
        <div class="row justify-content-center">

            <div class="card w-50">
                @switch($zayav->status_zayav->name)
                    @case('Принята')
                        <h5 class="card-header text-center bg-warning">Заявка {{$zayav->status_zayav->name}}</h5>                        
                        @break
                    @case('Готова')
                    <h5 class="card-header text-center bg-success">Заявка {{$zayav->status_zayav->name}}</h5>
                        @break
                    @case('На подписи')
                    <h5 class="card-header text-center bg-primary">Заявка {{$zayav->status_zayav->name}}</h5>
                        @break
                    @case('Отклонена')
                    <h5 class="card-header text-center bg-danger">Заявка {{$zayav->status_zayav->name}}</h5>
                        @break
                    @default
                        
                @endswitch
                <div class="card-body">
                    <h6 class="card-title text-center">
                       <b>Номер заявки <h5>{{$zayav->identify}}</h5></b>
                    </h6>
                    
                    <hr>
                    <div class="row">
                        <div class="col-6">
                            <p><b>Фамилия: </b> {{$zayav->familiya}}</p>
                            <p><b>Имя: </b>{{$zayav->imya}}</p>
                            <p><b>Отчество: </b>{{$zayav->otchestvo}}</p>
                            <p><b>Организация: </b>{{$zayav->Organization}}</p>
                        </div>
                        <div class="col-6">
                            <p><b>Год рождения: </b>{{$zayav->year}}</p>
                            <p><b>Группа: </b>{{$zayav->groups->year % 100}}{{$zayav->groups->specialties->short_name}}-{{$zayav->groups->number}}</p>
                            <p><b>Тип справки: </b>{{$zayav->type_spravka->name}}</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-6 text-center" data-toggle="tooltip" data-placement="top" title="{{$zayav->created_at}}">
                            Создано {{$zayav->created_at->diffForHumans()}}
                        </div>
                        <div class="col-6 text-center" data-toggle="tooltip" data-placement="top" title="{{$zayav->updated_at}}">
                            Обновлено {{$zayav->updated_at->diffForHumans()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection