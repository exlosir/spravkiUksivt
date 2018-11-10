<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Справки УКСИВТ')}}</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.bundle.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
</head>
<body>
    <header>
        <nav class="nav">
            <div class="container-fluid">
                <div class="row justify-content-center text-center align-items-center">
                    <div class="col-sm-6 col-xs-4"><a href="/"><img src="{{asset('img/logo.png')}}" class="logo-header"></a>
                        ГБПОУ УКСИВТ | Заказ справок
                    </div>
                    <div class="col-sm-6 col-xs-8">
                        <a href="/login" class="btn btn-primary">Вход на сайт</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <div class="container-fluid">
        <div class="row">
            @yield('sidebar')
            @yield('main')
        </div>
    </div>
    
    
</body>
</html>