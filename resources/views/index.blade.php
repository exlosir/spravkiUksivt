@extends('layouts.app')
@section('main')
        <div class="col-12">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="jumbotron">
                        <h1 class="display-4 text-center">Добро пожаловать!</h1>
                        <p class="lead">На этом сайте ты сможешь заказать себе справку, а так же отслеживать ее состояние.</p>
                        <hr class="my-4">
                        </p>
                        <div class="row">
                            <div class="col-6">
                                <a class="btn btn-outline-primary btn-lg btn-block" href="/spravka" role="button">Заказать справку</a>
                            </div>
                            <div class="col-6">
                                <a class="btn btn-outline-primary btn-lg btn-block" href="/status" role="button">Отслеживание статуса</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
@endsection
