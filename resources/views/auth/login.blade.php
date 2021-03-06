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
            <div class="card w-50 ">
                <h5 class="card-header text-center bheader">Вход в личный кабинет</h5>
                <div class="card-body">
                    <form action="" method="POST">
                        {{ csrf_field() }}
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Логин</span>
                            </div>
                            <input type="text" class="form-control" name="username">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Пароль</span>
                            </div>
                            <input type="text" class="form-control" name="password">
                        </div>

                        <input type="submit" class="btn btn-outline-success btn-block" value="Войти">

                    </form>
                </div>
            </div>
    </div>
</div>
@endsection
