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
                <h5 class="card-header text-center bheader">Статус заявки</h5>
                <div class="card-body">
                    <h6 class="card-title text-center">Введите код вашей заявки</h6>
                    <form action="" method="POST">
                        {{ csrf_field() }}
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Код</span>
                            </div>
                            <input type="text" class="form-control" name="year" placeholder="5100-0096-9621-2101">
                        </div>
                        <input type="submit" class="btn btn-outline-success btn-block" value="Узнать статус">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection