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
    <header class="mb-4">
        <nav class="nav">
            <div class="container-fluid">
                <div class="row justify-content-center text-center align-items-center">
                    <div class="col-sm-6 col-xs-4"><a href="/"><img src="{{asset('img/logo.png')}}" class="logo-header"></a>
                        ГБПОУ УКСИВТ | Заказ справок
                    </div>
                    <div class="col-sm-6 col-xs-8">
                        @guest
                            <a href="/login" class="btn btn-primary">Вход на сайт</a>
                        @endguest
                        @auth
                            <div class="dropdown">
                                <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{Auth::user()->familiya . " " .Auth::user()->imya}}
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                    <a href="/home" class="btn dropdown-item">Домашняя страница</a>
                                    {{-- @can('isAdmin', User::class)
                                        <a href="/admin" class="btn dropdown-item">Админ панель</a>
                                    @endcan --}}
                                    <a href="/logout" class="btn dropdown-item">Выход</a>
                                </div>
                            </div>
                        @endauth
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