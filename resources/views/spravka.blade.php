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
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            В случае заполнения формы <strong>неверными данными</strong>, заявка будет отклонена!
            Краткая информация по <strong>
                <!-- Button trigger modal -->
                <a href="" class="text-info pointer" data-toggle="modal" data-target="#exampleModalCenter">
                    заказу справок
                </a>
            </strong>

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
    <div class="row justify-content-center mb-4">

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
                        <select name="group" class="form-control">
                            <option value="">Не выбрано</option>
                            @foreach ($groups as $item)
                            <option value="{{$item->id}}">{{$item->year %
                                100}}{{$item->specialties->short_name}}-{{$item->number}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Тип справки</span>
                        </div>
                        <select name="type_spravka" class="form-control">
                            <option value="">Не выбрано</option>
                            @foreach ($types as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Организация</span>
                        </div>
                        <input type="text" class="form-control" name="area" placeholder="Соц.защита Орджоникидзевского района">
                    </div>
                    <input type="submit" class="btn btn-outline-success btn-block" value="Отправить заявку">
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Информация по заказу справки</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Для того, чтобы заказать справку - вам необходимо заполнить форму.
                Чтобы правильно заполнить, нужно ввести данные, как подсказывает вам каждое поле ввода.
                Тип справки играет важную роль и нужно правильно его выбрать. <br>
                <b>Неполная справка</b> - предназначена для подтверждения обучения в образовательной организации без
                полного информирования о вашей специальности, сроках и основы обучения. Подходит для предоставления в
                школу, на работу, в садик и иные подобные организации. Срок изготовления от 1 до 2 рабочих дней.<br>
                <b>Полная справка</b> - предназначена для подтверждения обучения в образовательной организации с полным
                информирование о вашей специальности, сроках и основы обучения. Предназначена для предоставления в
                организации, связанные с финансами (соц.защита, собес, мфц и т.д). Срок изготовления от 2 до 4 рабочих
                дней. <br>
                <b>Справка в пенсионный фонд</b> - предназначена для предоставления исключительно в Пенсионный фонд
                Российской Федерации. Срок изготовления от 2 до 4 рабочих дней.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>

@endsection
