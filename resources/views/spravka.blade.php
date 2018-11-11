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
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                В случае заполнения формы <strong>неверными данными</strong>, заявка будет отклонена!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        <div class="row justify-content-center">

            <div class="card w-50">
                <h5 class="card-header text-center bheader">Заказ справки</h5>
                <div class="card-body">
                    <form action="spravka/send" method="POST" id="send_zayav">
                        {{ csrf_field() }}
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">ФИО</span>
                            </div>
                            <input type="text" class="form-control" name="fio" placeholder="Иванов Иван Иванович">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Год рождения</span>
                            </div>
                            <input type="text" class="form-control" name="year" placeholder="2000">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Группа</span>
                            </div>
                            <input type="text" class="form-control" name="group" placeholder="18П-1">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Наименование организации</span>
                            </div>
                            <input type="text" class="form-control" name="organization" placeholder="Соц.защита">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Район организации</span>
                            </div>
                            <input type="text" class="form-control" name="area" placeholder="Орджоникидзевский район">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Отделение</span>
                            </div>
                            <select name="department" class="form-control">
                                <option value="">...</option>
                                @foreach ($department as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Основа обучения</span>
                            </div>
                            <select name="osn_obuch" class="form-control">
                                <option value="">...</option>
                                <option value="Бюджет">Бюджет</option>
                                <option value="Коммерция">Коммерция</option>
                            </select>
                        </div>
                        <input type="submit" class="btn btn-outline-success btn-block" value="Отправить заявку">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection