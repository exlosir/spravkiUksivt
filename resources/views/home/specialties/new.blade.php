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

{{-- Начало блока добавления специальности --}}

    <div class="card mb-3 ">
    <div class="card-header bg-info">
        Добавление специальности
    </div>
    <div class="card-body">
        <form action="{{ route('add_new_spec')}}" method="POST" class="w-auto">
                {{ csrf_field() }}
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Наименование</span>
                </div>
                <input type="text" name="name" class="form-control" placeholder="40.02.01 Право и организация социального обеспечения">
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Краткое наименование</span>
                </div>
                <input type="text" name="short_name" class="form-control" placeholder="ПО">
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Период обучения</span>
                </div>
                <input type="text" name="period_obuch" class="form-control" placeholder="2 года 10 месяцев">
            </div>

                <input type="submit" class="btn btn-outline-success btn-block" value="Добавить">
            </form>
        </div>
    </div>
{{-- Конец блока добавления специальности --}}
</div>
@endsection